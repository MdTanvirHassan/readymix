<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Delivery_challans extends Site_Controller {

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
//        $this->menu = 'sales';
//        $this->sub_menu = 'sale';
//        $this->sub_inner_menu = 'delivery_challan';

        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'delivery_challan';

        $this->titlebackend("Delivery Challan");
        // $data['sale_challan']=$this->m_common->get_row_array('tbl_sales_sale_challan
        // $sql="select dc.*,do.delivery_no,c.c_name,c.c_short_name from tbl_delivery_challans dc left join tbl_delivery_orders do on dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join tbl_customers c on q.customer_id=c.id where dc.is_active=1 order by dc_id DESC";
      //  $sql = "select dc.*,do.delivery_no,c.c_name,c.c_short_name from tbl_delivery_challans dc left join tbl_delivery_orders do on dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id where dc.is_active=1 and dc.delivery_challan_date>='2020-10-01' and dc.unit_id=" . $branch_id . " order by dc_id DESC";//27-12-2020
        // $sql = "select dc.*,do.delivery_no,c.c_name,c.c_short_name,tdcd.bill_status from tbl_delivery_challans dc 
        // left join tbl_delivery_challan_details tdcd on tdcd.dc_id=dc.dc_id 
        // left join tbl_delivery_orders do on dc.do_id=do.do_id 
        // left join tbl_sales_orders so on do.o_id=so.o_id 
        // left join tbl_customers c on so.customer_id=c.id where dc.is_active=1 and dc.delivery_challan_date>='2020-10-01' and dc.unit_id=" . $branch_id . " order by dc_id DESC";
        // $data['delivery_challans'] = $this->m_common->customeQuery($sql);
        $this->load->view('delivery_challans/v_delivery_challan', $data);
    }

    public function delv_challan_list(){
        $branch_id = $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
           // POST data
           $postData = $this->input->post();
           $user_id =$this->session->userdata('user_id');
          // $user_category =$this->session->userdata('user_category');
           $userData =$this->m_common->get_row_array('users',array('id' =>$user_id),'*');
           $this->role =checkUserPermission(13, 62, $userData);
           
           $this->load->library('DataTables');
           $this->datatables->setDatabase($this->db->database);
           $aTable = 'tbl_delivery_challans';
           $aColumns = array('tbl_delivery_challans.dc_id','tbl_delivery_challans.delivery_challan_date','tbl_delivery_challans.dc_no','tbl_delivery_challans.manual_dc_no','tbl_delivery_orders.delivery_no','tbl_customers.c_name','tbl_delivery_challans.project_name','tbl_delivery_challans.status','tbl_delivery_challan_details.bill_status');
           $joinTable = array('tbl_delivery_challan_details','tbl_delivery_orders','tbl_sales_orders','tbl_customers');
           $JoinCriteria = array('tbl_delivery_challan_details.dc_id=tbl_delivery_challans.dc_id','tbl_delivery_orders.do_id=tbl_delivery_challans.do_id','tbl_sales_orders.o_id=tbl_delivery_orders.o_id','tbl_customers.id=tbl_sales_orders.customer_id');
           $joinStatus = array('','left','left','left');
         //  $where = 'tbl_delivery_challans.unit_id='.$branch_id;
           $where['tbl_delivery_challans.unit_id']=$branch_id;
           $records = $this->datatables->get_json($aTable, $aColumns,$joinTable,$JoinCriteria,$joinStatus,$where);
          //echo $this->db->last_query();exit;
           $data = array();
           foreach($records['data'] as $key=>$record ){
      
               $data[$key] = array( 
                  "dc_id"=>$record->dc_id,
                  "delivery_challan_date"=>$record->delivery_challan_date,
                  "dc_no"=>$record->dc_no,
                  "manual_dc_no"=>$record->manual_dc_no,
                  "delivery_no"=>$record->delivery_no,
                  "c_name"=>$record->c_name,
                  
                  "project_name"=>$record->project_name,
                  "status"=>$record->status,
                ); 
                $action='';
                if($record->status=="Pending"){
                    if (in_array(4, $this->role)) {
                        $action.='<a href="'.site_url('delivery_challans/details_delivery_challan/'.$record->dc_id).'"><button class="btn btn-sm btn-success" >View</button></button></a>';
                    }
                    if (in_array(3, $this->role) || (in_array($userData[0]['user_type'],array(1,3)))){
                        $action.='<a href="'.site_url('delivery_challans/edit_delivery_challan/'.$record->dc_id).'"><button class="btn btn-sm btn-success" >Edit</a>';
                    }
                    if (in_array(2, $this->role)) {
                        $action.='<a href="'.site_url('delivery_challans/approve_delivery_challan/'.$record->dc_id).'"><button class="btn btn-sm btn-success">Approve</i></a>';
                    }
                    if (in_array(5, $this->role)) {
                        $action.='<button onclick="delete_row(\''.site_url('delivery_challans/delete_delivery_challan/'.$record->dc_id).'\')" class="btn btn-sm btn-danger">Delete</button>';
                    }
                
                
                
                
                }else{
                    if (in_array(4, $this->role)) {
                        $action.='<a href="'.site_url('delivery_challans/details_delivery_challan/'.$record->dc_id).'"><button class="btn btn-sm btn-success" >View</button></button></a>';
                    }
                    if (in_array(6, $this->role)) {
                        if($record->status=="Approved"){
                        if($record->bill_status=="Pending"){
                            $action.='<button onclick="canCel('.$record->dc_id.')" class="btn btn-sm btn-danger" >Return</button>';
                        }

                        }
                    }
                    
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

    function add_delivery_challan() {
        $branch_id = $this->session->userdata('companyId');
//        $this->menu = 'sales';
//        $this->sub_menu = 'sale';
//        $this->sub_inner_menu = 'delivery_challan';

        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'delivery_challan';


        $this->titlebackend("Quotation Information");
      //  $sql = "select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and do.status!='Delivered' and do.unit_id=" . $branch_id;
      //  $sql = "select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and do.status!='Delivered' and do.do_status='Approved' and do.unit_id=" . $branch_id;  
        $sql = "select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where (do.closing_status is null or do.closing_status!='Closed') and do.is_active=1 and do.status!='Delivered' and do.do_status='Approved' and do.unit_id=" . $branch_id;  
        
        $data['delivery_orders'] = $this->m_common->customeQuery($sql);
        //$data['customers']=$this->m_common->customeQuery($sql);
        $data['drivers'] = $this->m_common->get_row_array('tbl_driver', array('is_active' =>1,'transport_type'=>"Truck"), '*');
        $data['helpers'] = $this->m_common->get_row_array('tbl_helper', array('is_active' => 1), '*');
        $data['trucks'] = $this->m_common->get_row_array('tbl_truck', array('is_active' => 1,'transport_type'=>"Truck"), '*');
        $this->load->view('delivery_challans/v_add_delivery_challan_do', $data);
    }

    function add_delivery_challan_customer() {
        $branch_id = $this->session->userdata('companyId');
//        $this->menu = 'sales';
//        $this->sub_menu = 'sale';
//        $this->sub_inner_menu = 'delivery_challan';

        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'delivery_challan';


        $this->titlebackend("Quotation Information");
        //$sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and do.status!='Delivered' and do.unit_id=".$branch_id;
        $sql = "select do.*,c.id as c_id,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and do.status!='Delivered' and do.unit_id=" . $branch_id . " group by c.id";
        // $data['delivery_orders']=$this->m_common->customeQuery($sql);
        $data['customers'] = $this->m_common->customeQuery($sql);
        $data['drivers'] = $this->m_common->get_row_array('tbl_driver', array('is_active' => 1), '*');
        $data['helpers'] = $this->m_common->get_row_array('tbl_helper', array('is_active' => 1), '*');
        $data['trucks'] = $this->m_common->get_row_array('tbl_truck', array('is_active' => 1), '*');
        $this->load->view('delivery_challans/v_add_delivery_challan', $data);
    }

    function add_delivery_challan_action(){
        $user_id=$this->session->userdata('user_id');
        $branch_id = $this->session->userdata('companyId');
        $postData = $this->input->post();
        if(!empty($postData)){
            try{
                    
                    $insertData = array();
                    $customer_id = $postData['customer_id'];
                    if(empty($postData['select_product'])){
                        redirect_with_msg('delivery_challans/add_delivery_challan', 'Please Select Product');
                    }

                    if (!empty($postData['do_id'])) {
                        $insertData['do_id'] = $postData['do_id'];
                        $do_id = $postData['do_id'];
                    }

                    if(!empty($postData['challan_time'])){
                        $insertData['challan_time'] = $postData['challan_time'];
                    }


                    if (!empty($postData['distance'])) {
                        $insertData['distance'] = $postData['distance'];
                    }

        //             $pre_challan=$this->m_common->get_row_array('tbl_delivery_challans',array('do_id'=>$do_id,'status'=>"Pending"),'*');
        //             if(!empty($pre_challan)){
        //                redirect_with_msg('delivery_challans/add_delivery_challan', 'Already The challan for this order in pending');  
        //             }
                    // if(!empty($postData['dc_no'])){
                    //     $insertData['dc_no'] = $postData['dc_no'];
                    //     $pre_challan_info=$this->m_common->get_row_array('tbl_delivery_challans',array('dc_no'=>$postData['dc_no']),'*');
                    //     if(!empty($pre_challan_info)){
                    //         redirect_with_msg('delivery_challans', 'This challan already exists');
                    //     }

                    // }
                    if (!empty($postData['delivery_challan_date'])) {
                        $insertData['delivery_challan_date'] = date('Y-m-d', strtotime($postData['delivery_challan_date']));
                    }
                    if (!empty($postData['attention'])) {
                        $insertData['attention'] = $postData['attention'];
                    }
                    if (!empty($postData['phone'])) {
                        $insertData['phone'] = $postData['phone'];
                    }

                    if (!empty($postData['contact_person'])) {
                        $insertData['contact_person'] = $postData['contact_person'];
                    }
                    if (!empty($postData['contact_no'])) {
                        $insertData['contact_no'] = $postData['contact_no'];
                    }

                    if(!empty($postData['project_name'])){
                        $insertData['project_name'] = $postData['project_name'];
                    }
                    if (!empty($postData['project_id'])) {
                        $insertData['project_id'] = $postData['project_id'];
                    }
                    if (!empty($postData['billing_address'])) {
                        $insertData['billing_address'] = $postData['billing_address'];
                    }
                    if (!empty($postData['billing_email'])) {
                        $insertData['billing_email'] = $postData['billing_email'];
                    }
                    if (!empty($postData['shipping_address'])) {
                        $insertData['shipping_address'] = $postData['shipping_address'];
                    }
                    if (!empty($postData['shipping_email'])) {
                        $insertData['shipping_email'] = $postData['shipping_email'];
                    }

                    if (!empty($postData['total_amount'])) {
                        $insertData['total_amount'] = $postData['total_amount'];
                    }

                    if (!empty($postData['driver_id'])){
                        $insertData['driver_id'] = $postData['driver_id'];
                    }
                    if (!empty($postData['helper_id'])) {
                        $insertData['helper_id'] = $postData['helper_id'];
                    }

                    if (!empty($postData['truck_id'])) {
                        $insertData['truck_id'] = $postData['truck_id'];
                    }

                    
                    if(!empty($postData['manual_dc_no'])){
                        $insertData['manual_dc_no'] = $postData['manual_dc_no'];
                    }
                    
                    
                    $insertData['created_by'] =$user_id;
                    
                    $insertData['unit_id'] =$branch_id;
                    $insertData['is_active'] =1;
                    $insertData['status'] ='Pending';

                    $insertData['challan_date_time'] =date('Y-m-d H:i:s');
                    $insertData['created_date'] = date('Y-m-d');
                    
                    

                    $this->db->trans_start();
                    
                    $result = $this->m_common->insert_row('tbl_delivery_challans',$insertData);
                    if (!empty($result)) {
                        //$this->m_common->insert_row('tbl_delivery_challan_code', array('challan_code' => $postData['challan_code'], 'customer_id' => $postData['customer_id'], 'unit_id' => $branch_id));
                        // $this->m_common->update_row('tbl_delivery_orders', array('do_id' =>$do_id),array('status'=>"Delivered"));
                        foreach ($postData['s_item_id'] as $key => $each) {
                            if (in_array($each, $postData['select_product'])) {
                                $insertData1 = array();
                                $insertData1['dc_id'] = $result;
                                $insertData1['s_item_id'] = $each;
                                $insertData1['is_active'] = 1;
                                $insertData1['bill_status'] = 'Pending';
                                $insertData1['receive_status'] = 'Pending';
                                if (empty($each)) {
                                    continue;
                                }
                                if (!empty($postData['quantity'][$key])) {
                                    $insertData1['quantity'] = $postData['quantity'][$key];
                                    $insertData1['challan_qty'] = $postData['quantity'][$key];
                                }
                                
                                

                                if (!empty($postData['mu_name'][$key])) {
                                    $insertData1['mu_name'] = strtoupper($postData['mu_name'][$key]);
                                }
                                
//                                if(isset($postData['base_price'][$key]) && !empty($postData['base_price'][$key])) { 
//                                   $insertData1['base_price'] = $postData['base_price'][$key];
//                                }
//                                if(isset($postData['vat'][$key]) && !empty($postData['vat'][$key])) { 
//                                   $insertData1['vat'] = $postData['vat'][$key];
//                                }
                                
                                if (!empty($postData['unit_price'][$key])) {
                                    $insertData1['unit_price'] = $postData['unit_price'][$key];
                                    $vat=round(($postData['unit_price'][$key]*15)/115,2);
                                    $base_price=$postData['unit_price'][$key]-$vat;
                                    $insertData1['base_price'] =$base_price;
                                    $insertData1['vat'] =$vat;
                                }
//                                if (!empty($postData['amount'][$key])) {
//                                    $insertData1['amount'] = $postData['amount'][$key];
//                                }
                                
                                $insertData1['amount'] =$postData['unit_price'][$key]*$postData['quantity'][$key];
                                if(!empty($postData['remark'][$key])) { 
                                    $insertData1['remarks'] = $postData['remark'][$key];
                                }

                                $this->m_common->insert_row('tbl_delivery_challan_details', $insertData1);
                            }
                        }
                        // qty update for do
                        $delivery_challan_info = $this->m_common->get_row_array('tbl_delivery_challans', array('dc_id' => $result), '*');
                        $delivery_challan_products = $this->m_common->get_row_array('tbl_delivery_challan_details', array('dc_id' => $result), '*');
                        $dcd_sql="select * from tbl_delivery_challan_details dcd left join tbl_sales_products tsp on dcd.s_item_id=tsp.product_id where dcd.dc_id=$result";
                        $delivery_challan_products=$this->m_common->customeQuery($dcd_sql);
                        if(!empty($result)){
                            
                            foreach ($delivery_challan_products as $c_product){
                                if($c_product['product_name']!="Water"){
                                    $delivery_order_products = array();
                                    $delivery_order_product = $this->m_common->get_row_array('tbl_delivery_order_details', array('do_id' => $delivery_challan_info[0]['do_id'], 's_item_id' => $c_product['s_item_id']), '*');
                                    $delivery_quanity = $delivery_order_product[0]['delivery_quantity'] + $c_product['quantity'];
                                    $this->m_common->update_row('tbl_delivery_order_details', array('do_id' => $delivery_challan_info[0]['do_id'], 's_item_id' => $c_product['s_item_id']), array('delivery_quantity' => $delivery_quanity));
                                }
                            }
                        }
                        // qty update finished for do      

                    }

                    $this->db->trans_complete();
                
                    if($this->db->trans_status() === FALSE){
                        $this->db->trans_rollback();
                    }else{
                        $this->db->trans_commit();
                    }   
                    redirect_with_msg('delivery_challans', 'Successfully Inserted');
            }catch(UserException $error){
                $this->db->trans_rollback();               
                redirect_with_msg('delivery_challans', 'Something went wrong');
            }        
            
        } else {
            redirect_with_msg('delivery_challans/add_delivery_challan', 'Please fill the form and submit');
        }
    }

    function edit_delivery_challan($id) {
        $branch_id = $this->session->userdata('companyId');
//        $this->menu = 'sales';
//        $this->sub_menu = 'sale';
//        $this->sub_inner_menu = 'delivery_challan';

        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'delivery_challan';


        $this->titlebackend("Delivery Challan Information");
        // $sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Pending' or do.status='Partially Delivered' or do.status='Delivered') ";
        $sql = "select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Pending' or do.status='Partially Delivered' or do.status='Delivered') and do.unit_id=" . $branch_id;
        $data['delivery_orders'] = $this->m_common->customeQuery($sql);
        $data['delivery_challan_info'] = $this->m_common->get_row_array('tbl_delivery_challans', array('dc_id' => $id), '*');
        // $sql="select d.*,item.s_item_name from tbl_delivery_challan_details d left join tbl_sales_items item on d.s_item_id=item.s_item_id where d.is_active=1";
        $sql = "select d.*,dc.do_id,sod.remark,sp.product_name,sp.measurement_unit from tbl_delivery_challan_details d 
left join tbl_delivery_challans as dc on dc.dc_id=d.dc_id
left JOIN tbl_delivery_orders doo on doo.do_id=dc.do_id
LEFT JOIN tbl_sales_orders so on so.o_id=doo.o_id
LEFT JOIN tbl_sales_order_details sod on so.o_id=sod.o_id
left join tbl_sales_products sp on d.s_item_id=sp.product_id where d.is_active=1 and d.dc_id=" . $id . " GROUP BY d.s_item_id";
        $data['delivery_challan_details_info'] = $this->m_common->customeQuery($sql);

        $sql = "select d.*,i.product_name,i.measurement_unit from tbl_delivery_order_details d left join tbl_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and d.do_id=" . $data['delivery_challan_info'][0]['do_id'];
        $data['order_products'] = $this->m_common->customeQuery($sql);

        foreach ($data['order_products'] as $key => $value) {
            $p_statement = array();
            $p_sql = "select sum(production_qty) as total_production_qty from tbl_production_statement_details tpsd where tpsd.product_id=" . $value['s_item_id'] . " and tpsd.do_id=" . $data['delivery_challan_info'][0]['do_id'];
            $p_statement = $this->m_common->customeQuery($p_sql);
            if (!empty($p_statement)) {
                $data['order_products'][$key]['production_qty'] = $p_statement[0]['total_production_qty'];
            } else {
                $data['order_products'][$key]['production_qty'] = '';
            }
        }
        $data['drivers'] = $this->m_common->get_row_array('tbl_driver', array('is_active' => 1,'transport_type'=>"Truck"), '*');
        $data['helpers'] = $this->m_common->get_row_array('tbl_helper', array('is_active' => 1), '*');
        $data['trucks'] = $this->m_common->get_row_array('tbl_truck', array('is_active' => 1,'transport_type'=>"Truck"), '*');

        $this->load->view('delivery_challans/v_edit_delivery_challan', $data);
    }

    function edit_delivery_challan_action($dc_id) {
        $user_id=$this->session->userdata('user_id');
        $postData=$this->input->post();
        if(!empty($postData)){
            $pre_info = $this->m_common->get_row_array('tbl_delivery_challans', array('do_id' => $do_id), '*');
            $insertData = array();

            if(empty($postData['select_product'])){
                redirect_with_msg('delivery_challans/edit_delivery_challan_action/' . $dc_id, 'Please Select Product');
            }

            if(!empty($postData['do_id'])){
                $insertData['do_id'] = $postData['do_id'];
                $do_id = $postData['do_id'];
            }

            if (!empty($postData['delivery_challan_date'])) {
                $insertData['delivery_challan_date'] = date('Y-m-d', strtotime($postData['delivery_challan_date']));
            }

            if (!empty($postData['challan_time'])) {
                $insertData['challan_time'] = $postData['challan_time'];
            }
            // if(!empty($postData['challan_time'])){
            $insertData['distance'] = $postData['distance'];
            // }

            if (!empty($postData['attention'])) {
                $insertData['attention'] = $postData['attention'];
            }
            if (!empty($postData['phone'])) {
                $insertData['phone'] = $postData['phone'];
            }

            if (!empty($postData['contact_person'])) {
                $insertData['contact_person'] = $postData['contact_person'];
            }
            if (!empty($postData['contact_no'])) {
                $insertData['contact_no'] = $postData['contact_no'];
            }

            if (!empty($postData['project_name'])) {
                $insertData['project_name'] = $postData['project_name'];
            }
            if (!empty($postData['project_id'])) {
                $insertData['project_id'] = $postData['project_id'];
            }
            if (!empty($postData['billing_address'])) {
                $insertData['billing_address'] = $postData['billing_address'];
            }
            if (!empty($postData['billing_email'])) {
                $insertData['billing_email'] = $postData['billing_email'];
            }
            if (!empty($postData['shipping_address'])) {
                $insertData['shipping_address'] = $postData['shipping_address'];
            }
            if (!empty($postData['shipping_email'])) {
                $insertData['shipping_email'] = $postData['shipping_email'];
            }

            if (!empty($postData['total_amount'])) {
                $insertData['total_amount'] = $postData['total_amount'];
            }

            if (!empty($postData['driver_id'])) {
                $insertData['driver_id'] = $postData['driver_id'];
            }
            if (!empty($postData['helper_id'])) {
                $insertData['helper_id'] = $postData['helper_id'];
            }

            if (!empty($postData['truck_id'])) {
                $insertData['truck_id'] = $postData['truck_id'];
            }
            
            
            if(!empty($postData['manual_dc_no'])){
                $insertData['manual_dc_no'] = $postData['manual_dc_no'];
            }
            
            
            $insertData['updated_by'] =$user_id;

            $this->db->trans_start();
            
            $result = $this->m_common->update_row('tbl_delivery_challans', array('dc_id' => $dc_id), $insertData);
            if ($result >= 0){
                if ($pre_info[0]['do_id'] != $do_id) {
                    // $this->m_common->update_row('tbl_delivery_orders', array('do_id' =>$do_id),array('status'=>"Delivered"));
                    // $this->m_common->update_row('tbl_delivery_orders', array('do_id' =>$pre_info[0]['do_id']),array('status'=>"Pending"));
                }
                $exists = $this->m_common->get_row_array('tbl_delivery_challan_details', array('dc_id' => $dc_id), '*');
                $this->m_common->delete_row('tbl_delivery_challan_details', array('dc_id' => $dc_id));
                foreach ($postData['s_item_id'] as $key => $each) {
                    if (in_array($each, $postData['select_product'])) {
                        $insertData1 = array();
                        $insertData1['dc_id'] = $dc_id;
                        $insertData1['s_item_id'] = $each;
                        $insertData1['is_active'] = 1;
                        $insertData1['bill_status'] = 'Pending';
                        $insertData1['receive_status'] = 'Pending';
                        if (empty($each)) {
                            continue;
                        }
                        if(!empty($postData['quantity'][$key])){
                            $insertData1['quantity'] = $postData['quantity'][$key];
                            $insertData1['challan_qty'] = $postData['quantity'][$key];
                        }

                        if(!empty($postData['mu_name'][$key])){
                            $insertData1['mu_name'] = strtoupper($postData['mu_name'][$key]);
                        }

//                        if(isset($postData['base_price'][$key]) && !empty($postData['base_price'][$key])) { 
//                           $insertData1['base_price'] = $postData['base_price'][$key];
//                        }
//                        if(isset($postData['vat'][$key]) && !empty($postData['vat'][$key])) { 
//                           $insertData1['vat'] = $postData['vat'][$key];
//                        }
                        
                        if(!empty($postData['unit_price'][$key])){
                            $insertData1['unit_price'] = $postData['unit_price'][$key];
                            $vat=round(($postData['unit_price'][$key]*15)/115,2);
                            $base_price=$postData['unit_price'][$key]-$vat;
                            $insertData1['base_price'] =$base_price;
                            $insertData1['vat'] =$vat;
                        }
//                        if (!empty($postData['amount'][$key])) {
//                            $insertData1['amount'] = $postData['amount'][$key];
//                        }
                        
                        
                        $insertData1['amount'] =$postData['unit_price'][$key]*$postData['quantity'][$key];
                        if(!empty($postData['remark'][$key])) { 
                            $insertData1['remarks'] = $postData['remark'][$key];
                        }

                        $this->m_common->insert_row('tbl_delivery_challan_details', $insertData1);

                        $sql = "select d.*,i.product_name,i.measurement_unit 
from tbl_delivery_order_details d left join tbl_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and d.s_item_id=$each and d.do_id=" . $do_id;
                        $d=$this->m_common->customeQuery($sql);
                        if(!empty($d)){
                            $qty = $d[0]['delivery_quantity'] - $exists[0]['quantity'];
                            $qty = $qty + $postData['quantity'][$key];
                            $this->m_common->update_row('tbl_delivery_order_details', array('do_details_id' => $d[0]['do_details_id']), array('delivery_quantity' => $qty));
                        }
                    }
                }
                
            }
            
            
            $this->db->trans_complete();                
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }   
            
            
            redirect_with_msg('delivery_challans', 'Successfully Updated');
            
        } else {

            redirect_with_msg('delivery_challans/edit_delivery_challan_action/' . $dc_id, 'Please fill the form first');
        }
    }

    function details_delivery_challan($id, $print = false,$p_type=false) {
        $branch_id = $this->session->userdata('companyId');
//        $this->menu = 'sales';
//        $this->sub_menu = 'sale';
//        $this->sub_inner_menu = 'delivery_challan';

        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'delivery_challan';



        $this->titlebackend("Delivery Challan Information");
        //$sql="select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Pending' or do.status='Partially Delivered' or do.status='Delivered') ";
        $sql = "select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Pending' or do.status='Partially Delivered' or do.status='Delivered') and do.unit_id=" . $branch_id;
        $data['delivery_orders'] = $this->m_common->customeQuery($sql);
        //   $dc_sql="select dc.*,so.order_no,so.sale_order_date,c.c_name from tbl_delivery_challans dc left join tbl_delivery_orders do on dc.do_id=dc.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where dc.dc_id=".$id;
       // $dc_sql = "select dc.*,so.order_no,so.sale_order_date,c.id,c.c_short_name,c.c_name,c.c_contact_person,c.c_mobile_no,c.c_contact_address,td.driver_name,td.contact_no as d_contact_no,th.helper_name,th.contact_no as h_contact_no,tt.truck_no,do.delivery_order_date from tbl_delivery_challans dc left join tbl_delivery_orders do on dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_driver td on dc.driver_id=td.driver_id left join tbl_helper th on dc.helper_id=th.helper_id left join tbl_truck tt on dc.truck_id=tt.truck_id where dc.dc_id=" . $id; //07-11-2022
        $dc_sql = "select dc.*,so.c_order_no,so.order_no,so.sale_order_date,c.id,c.c_short_name,c.c_name,c.c_contact_person,c.c_mobile_no,c.c_contact_address,td.driver_name,td.contact_no as d_contact_no,th.helper_name,th.contact_no as h_contact_no,tt.truck_no,do.delivery_order_date,br.dep_description from tbl_delivery_challans dc 
        left join tbl_delivery_orders do on dc.do_id=do.do_id 
        left join tbl_sales_orders so on do.o_id=so.o_id 
        left join tbl_sales_quotation sq on so.q_id=sq.q_id 
        left join tbl_customers c on so.customer_id=c.id 
        left join tbl_driver td on dc.driver_id=td.driver_id 
        left join tbl_helper th on dc.helper_id=th.helper_id 
        left join tbl_truck tt on dc.truck_id=tt.truck_id 
        left join department br on dc.unit_id=br.d_id
        where dc.dc_id=" . $id;
        $data['delivery_challan_info'] = $this->m_common->customeQuery($dc_sql);
        //echo '<pre>';print_r($data['delivery_challan_info']);exit;
   
        // $sql="select d.*,item.s_item_name from tbl_delivery_challan_details d left join tbl_sales_items item on d.s_item_id=item.s_item_id where d.is_active=1";
        $sql = "select d.*,dc.do_id,sod.remark,sp.product_name,sp.measurement_unit from tbl_delivery_challan_details d 
left join tbl_delivery_challans as dc on dc.dc_id=d.dc_id
left JOIN tbl_delivery_orders doo on doo.do_id=dc.do_id
LEFT JOIN tbl_sales_orders so on so.o_id=doo.o_id
LEFT JOIN tbl_sales_order_details sod on so.o_id=sod.o_id
left join tbl_sales_products sp on d.s_item_id=sp.product_id where d.is_active=1 and d.dc_id=" . $id . " GROUP BY d.s_item_id";
        $data['delivery_challan_details_info'] = $this->m_common->customeQuery($sql);

        $sql = "select d.*,i.product_name,i.measurement_unit from tbl_delivery_order_details d left join tbl_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and d.do_id=" . $data['delivery_challan_info'][0]['do_id'];
        $data['order_products'] = $this->m_common->customeQuery($sql);

        $data['drivers'] = $this->m_common->get_row_array('tbl_driver', array('is_active' => 1,'transport_type'=>"Truck"), '*');
        $data['helpers'] = $this->m_common->get_row_array('tbl_helper', array('is_active' => 1), '*');
        $data['trucks'] = $this->m_common->get_row_array('tbl_truck', array('is_active' => 1,'transport_type'=>"Truck"), '*');
        $sql = "select count(*) as sl from tbl_delivery_challans where dc_id <= $id and is_active=1";
        $data['sl'] = $this->m_common->customeQuery($sql);
        if ($print == false) {
            $this->load->view('delivery_challans/v_details_delivery_challan', $data);
        } else {
            if(empty($data['delivery_challan_info'][0]['dc_no'])){
                $branch_info=$this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
                $branch = $branch_info[0]['short_name'];
                $order_code = $this->m_common->get_row_array('tbl_delivery_challan_code', array('customer_id' => $data['delivery_challan_info'][0]['id'], 'unit_id' => $branch_id), '*', '', 1, 'id', 'DESC');
                if (!empty($order_code)) {
                    $item_id = $order_code[0]['challan_code']+1;
                } else {
                    $item_id = "";
                }
                if ($item_id != '') {
                    if ($item_id > 999) {
                        //item_sl_no = item_id;
                        $item_sl_no = $branch.'/CH/'. $data['delivery_challan_info'][0]['c_short_name']. '/'.date('y').'/'.$item_id;
                    } else if ($item_id > 99) {
                        $item_sl_no = $branch.'/CH/'. $data['delivery_challan_info'][0]['c_short_name']. '/'.date('y/')."0".$item_id;
                    } else if ($item_id > 9) {
                        $item_sl_no = $branch.'/CH/'. $data['delivery_challan_info'][0]['c_short_name']. '/'.date('y/')."00".$item_id;
                    } else {
                        $item_sl_no = $branch.'/CH/'. $data['delivery_challan_info'][0]['c_short_name']. '/'.date('y/')."000".$item_id;
                    }
                } else {
                    $item_id = 1;
                    $item_sl_no = $branch.'/CH/'. $data['delivery_challan_info'][0]['c_short_name']. '/'.date('y/')."0001";
                }




                $this->m_common->update_row('tbl_delivery_challans', array('dc_id' => $id),array('dc_no'=>$item_sl_no)); 
                $this->m_common->insert_row('tbl_delivery_challan_code', array('challan_code' => $item_id, 'customer_id' => $data['delivery_challan_info'][0]['id'], 'unit_id' => $branch_id)); 
            }
           // $dc_sql = "select dc.*,so.order_no,so.sale_order_date,c.id,c.c_short_name,c.c_name,c.c_contact_person,c.c_mobile_no,c.c_contact_address,td.driver_name,td.contact_no as d_contact_no,th.helper_name,th.contact_no as h_contact_no,tt.truck_no,do.delivery_order_date from tbl_delivery_challans dc left join tbl_delivery_orders do on dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_driver td on dc.driver_id=td.driver_id left join tbl_helper th on dc.helper_id=th.helper_id left join tbl_truck tt on dc.truck_id=tt.truck_id where dc.dc_id=" . $id;
           $dc_sql = "select dc.*,so.order_no,so.sale_order_date,c.id,c.c_short_name,c.c_name,c.c_contact_person,c.c_mobile_no,c.c_contact_address,td.driver_name,td.contact_no as d_contact_no,th.helper_name,th.contact_no as h_contact_no,tt.truck_no,do.delivery_order_date,br.dep_description from tbl_delivery_challans dc 
           left join tbl_delivery_orders do on dc.do_id=do.do_id 
           left join tbl_sales_orders so on do.o_id=so.o_id 
           left join tbl_sales_quotation sq on so.q_id=sq.q_id 
           left join tbl_customers c on so.customer_id=c.id 
           left join tbl_driver td on dc.driver_id=td.driver_id 
           left join tbl_helper th on dc.helper_id=th.helper_id 
           left join tbl_truck tt on dc.truck_id=tt.truck_id 
           left join department br on dc.unit_id=br.d_id
           where dc.dc_id=" . $id;
        $data['delivery_challan_info'] = $this->m_common->customeQuery($dc_sql);
            if($p_type=='half'){
                $html = $this->load->view('delivery_challans/print_half_delivery_challan', $data, true);
            }else{
                $html = $this->load->view('delivery_challans/print_delivery_challan', $data, true);
            }
            echo $html;
            exit;
        }
    }

    function approve_delivery_challan($id) {
        $this->menu = 'sales';
        $this->sub_menu = 'delivery_challan';
        $this->titlebackend("Delivery Challan Information");
        try{
            $this->db->trans_start();
            $delivery_challan_info = $this->m_common->get_row_array('tbl_delivery_challans', array('dc_id' => $id), '*');
           // $delivery_challan_products = $this->m_common->get_row_array('tbl_delivery_challan_details', array('dc_id' => $id), '*');
            $dcd_sql="select * from tbl_delivery_challan_details dcd left join tbl_sales_products tsp on dcd.s_item_id=tsp.product_id where dcd.dc_id=$id";
            $delivery_challan_products=$this->m_common->customeQuery($dcd_sql);
            $result = $this->m_common->update_row('tbl_delivery_challans', array('dc_id' => $id), array('status' => "Approved"));
            if(!empty($result)){
                foreach ($delivery_challan_products as $c_product) {
                    if($c_product['product_name']!="Water"){
                        $delivery_order_products=array();
                        $delivery_order_product =$this->m_common->get_row_array('tbl_delivery_order_details', array('do_id' => $delivery_challan_info[0]['do_id'], 's_item_id' => $c_product['s_item_id']), '*');
                        $delivery_quanity=$delivery_order_product[0]['delivery_quantity']; // + $c_product['quantity'];
                        if($delivery_quanity==$delivery_order_product[0]['quantity']){
                            $status = "Delivered";
                        } else {
                            $status = "Partially Delivered";
                        }
                        $this->m_common->update_row('tbl_delivery_order_details', array('do_id' => $delivery_challan_info[0]['do_id'], 's_item_id' => $c_product['s_item_id']), array('delivery_status' => $status));
                    }
                }
            }
            $delivery_order_products = $this->m_common->get_row_array('tbl_delivery_order_details', array('do_id' => $delivery_challan_info[0]['do_id']), '*');
            $j = 0;
            foreach ($delivery_order_products as $delivery_product) {
                if ($delivery_product['delivery_status'] != "Delivered") {
                    $j = 1;
                }
            }

            if ($j == 1) {
                $this->m_common->update_row('tbl_delivery_orders', array('do_id' => $delivery_challan_info[0]['do_id']), array('status' => "Partially Delivered"));
            } else {
                $this->m_common->update_row('tbl_delivery_orders', array('do_id' => $delivery_challan_info[0]['do_id']), array('status' => "Delivered"));
            }
            
            $this->db->trans_complete();
                
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }   
            redirect_with_msg('delivery_challans/index', 'Successfully Approved');
        }catch(UserException $error){
            $this->db->trans_rollback();            
            redirect_with_msg('delivery_challans/index', 'Something Went Wrong');
        }      
    }
    
    function delivery_challan_partial_receive($id){
        $branch_id = $this->session->userdata('companyId');
        
        $this->menu='production';
        $this->sub_menu='production';
        $this->sub_inner_menu='delivery_challan';

        $this->titlebackend("Delivery Challan Information");
        $sql = "select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Pending' or do.status='Partially Delivered' or do.status='Delivered') and do.unit_id=" . $branch_id;
        $data['delivery_orders'] = $this->m_common->customeQuery($sql);
        
        $data['delivery_challan_info'] = $this->m_common->get_row_array('tbl_delivery_challans', array('dc_id' => $id), '*');
        // $sql="select d.*,item.s_item_name from tbl_delivery_challan_details d left join tbl_sales_items item on d.s_item_id=item.s_item_id where d.is_active=1";
        $sql = "select d.*,dc.do_id,sod.remark,sp.product_name,sp.measurement_unit from tbl_delivery_challan_details d 
left join tbl_delivery_challans as dc on dc.dc_id=d.dc_id
left JOIN tbl_delivery_orders doo on doo.do_id=dc.do_id
LEFT JOIN tbl_sales_orders so on so.o_id=doo.o_id
LEFT JOIN tbl_sales_order_details sod on so.o_id=sod.o_id
left join tbl_sales_products sp on d.s_item_id=sp.product_id where d.is_active=1 and d.dc_id=" . $id . " GROUP BY d.s_item_id";
        $data['delivery_challan_details_info'] = $this->m_common->customeQuery($sql);

        $sql ="select d.*,i.product_name,i.measurement_unit from tbl_delivery_order_details d left join tbl_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and d.do_id=" . $data['delivery_challan_info'][0]['do_id'];
        $data['order_products'] = $this->m_common->customeQuery($sql);

        $this->load->view('delivery_challans/v_delivery_challan_partial_receive', $data);
    }
    
    
    function delivery_challan_partial_receive_action($dc_id){
        $user_id=$this->session->userdata('user_id');
        $postData=$this->input->post();
        if(!empty($postData)){
            $pre_info=$this->m_common->get_row_array('tbl_delivery_challans',array('do_id' =>$do_id),'*');
            $insertData=array();

            

            if(!empty($postData['do_id'])){
                $insertData['do_id'] = $postData['do_id'];
                $do_id = $postData['do_id'];
            }

            

            if(!empty($postData['total_amount'])){
                $insertData['total_amount'] = $postData['total_amount'];
            }
       
            $insertData['updated_by']=$user_id;
            $insertData['partial_receive_status']="Partial Received";
                    
            $this->db->trans_start();
            
            $result = $this->m_common->update_row('tbl_delivery_challans', array('dc_id' => $dc_id), $insertData);
            if ($result >= 0){
                
                $exists = $this->m_common->get_row_array('tbl_delivery_challan_details',array('dc_id' =>$dc_id),'*');
                $this->m_common->delete_row('tbl_delivery_challan_details', array('dc_id' => $dc_id));
                foreach ($postData['s_item_id'] as $key => $each) {
                    
                        $insertData1 = array();
                        $insertData1['dc_id'] = $dc_id;
                        $insertData1['s_item_id'] = $each;
                        $insertData1['is_active'] = 1;
                        $insertData1['bill_status'] = 'Pending';
                        $insertData1['receive_status'] = 'Pending';
                        if (empty($each)) {
                            continue;
                        }
                        $challan_qty=$postData['challan_qty'][$key];
                        if(!empty($postData['challan_qty'][$key])){
                            $insertData1['challan_qty'] = $postData['challan_qty'][$key];
                        }
                        
                        if(!empty($postData['quantity'][$key])){
                            $insertData1['quantity'] = $postData['quantity'][$key];
                        }

                        
                        
                        if(!empty($postData['mu_name'][$key])){
                            $insertData1['mu_name'] = strtoupper($postData['mu_name'][$key]);
                        }

                        if(!empty($postData['unit_price'][$key])){
                            $insertData1['unit_price'] = $postData['unit_price'][$key];
                        }
//                        if (!empty($postData['amount'][$key])) {
//                            $insertData1['amount'] = $postData['amount'][$key];
//                        }
                        $insertData1['amount'] =$postData['unit_price'][$key]*$postData['quantity'][$key];

                        $this->m_common->insert_row('tbl_delivery_challan_details', $insertData1);

                        $sql = "select d.*,i.product_name,i.measurement_unit 
from tbl_delivery_order_details d left join tbl_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and d.s_item_id=$each and d.do_id=" . $do_id;
                        $d=$this->m_common->customeQuery($sql);
                        if(!empty($d)){
                            $qty=$d[0]['delivery_quantity']-$exists[0]['quantity'];
                            $qty=$qty + $postData['quantity'][$key];
                            $this->m_common->update_row('tbl_delivery_order_details',array('do_details_id' =>$d[0]['do_details_id']),array('delivery_quantity' =>$qty));
                        }
                    
                }
                
            }
            
            
            $this->db->trans_complete();                
            if($this->db->trans_status()===FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }   
            
            
            redirect_with_msg('delivery_challans','Successfully Received');
            
        } else {

            redirect_with_msg('delivery_challans/edit_delivery_challan_action/'.$dc_id, 'Please fill the form first');
        }
    }
    
    
    
    function cancel_delivery_challan(){
        $this->menu ='sales';
        $this->sub_menu ='delivery_challan';
        $this->titlebackend("Delivery Challan Information");
        try{
                $this->db->trans_start();
                
                $id=$this->input->post('challan_id');
                $remark=$this->input->post('remark');
                
                $this->m_common->update_row('tbl_delivery_challans', array('dc_id' => $id),array('remark'=>$remark,'status' => "Canceled"));
                $do_id = $this->m_common->get_row_array('tbl_delivery_challans', array('dc_id' => $id), '*');
                $delivery_challan_info=$do_id;
                //$delivery_challan_products = $this->m_common->get_row_array('tbl_delivery_challan_details', array('dc_id' => $id), '*');
                $dcd_sql="select * from tbl_delivery_challan_details dcd left join tbl_sales_products tsp on dcd.s_item_id=tsp.product_id where dcd.dc_id=$id";
                $delivery_challan_products=$this->m_common->customeQuery($dcd_sql);

                foreach ($delivery_challan_products as $c_product) {
                    if($c_product['product_name']!="Water"){
                        $delivery_order_products=array();
                        $delivery_order_product=$this->m_common->get_row_array('tbl_delivery_order_details', array('do_id' => $delivery_challan_info[0]['do_id'], 's_item_id' => $c_product['s_item_id']), '*');
                        $delivery_quanity =$delivery_order_product[0]['delivery_quantity']-$c_product['quantity'];
                        $this->m_common->update_row('tbl_delivery_order_details', array('do_id' => $delivery_challan_info[0]['do_id'], 's_item_id' =>$c_product['s_item_id']), array('delivery_quantity' =>$delivery_quanity));
                    }
                }




                $delivery_challan_info = $this->m_common->get_row_array('tbl_delivery_challans', array('dc_id' => $id), '*');
                $delivery_challan_products = $this->m_common->get_row_array('tbl_delivery_challan_details', array('dc_id' => $id), '*');
                $result = $this->m_common->update_row('tbl_delivery_challans', array('dc_id' => $id), array('status' => "Canceled"));
                if (!empty($result)) {
                    foreach ($delivery_challan_products as $c_product){
                        $delivery_order_products = array();
                        $delivery_order_product = $this->m_common->get_row_array('tbl_delivery_order_details', array('do_id' => $delivery_challan_info[0]['do_id'], 's_item_id' =>$c_product['s_item_id']),'*');
                        $delivery_quanity = $delivery_order_product[0]['delivery_quantity']; // + $c_product['quantity'];
                        if ($delivery_quanity == $delivery_order_product[0]['quantity']) {
                            $status = "Delivered";
                        }else if($delivery_quanity==0){ 
                            $status = "Pending";
                        }else {
                            $status = "Partially Delivered";
                        }
                        $this->m_common->update_row('tbl_delivery_order_details', array('do_id' => $delivery_challan_info[0]['do_id'], 's_item_id' => $c_product['s_item_id']), array('delivery_status' => $status));
                    }
                }
                $delivery_order_products = $this->m_common->get_row_array('tbl_delivery_order_details', array('do_id' => $delivery_challan_info[0]['do_id']), '*');
                $j = 0;
                foreach ($delivery_order_products as $delivery_product){
                    if($delivery_product['delivery_status'] != "Delivered"){
                        $j = 1;
                    }
                }

                if($j == 1){
                    $this->m_common->update_row('tbl_delivery_orders', array('do_id' => $delivery_challan_info[0]['do_id']), array('status' => "Partially Delivered"));
                } else {
                    $this->m_common->update_row('tbl_delivery_orders', array('do_id' => $delivery_challan_info[0]['do_id']), array('status' => "Delivered"));
                }
                
                $this->db->trans_complete();
                
                if($this->db->trans_status()===FALSE){
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                }   
                
                redirect_with_msg('delivery_challans/index', 'Successfully Canceled');
        }catch(UserException $error){
            $this->db->trans_rollback();            
            redirect_with_msg('delivery_challans/index', 'Something Went Wrong');
        }        
    }
    

    function delete_delivery_challan($id){
        if (!empty($id)){
           try{ 
                $this->db->trans_start();
                
                $do_id = $this->m_common->get_row_array('tbl_delivery_challans', array('dc_id' => $id), '*');
                $r=$this->m_common->update_row('tbl_delivery_challans', array('dc_id' => $id), array('is_active' =>0));
               
                $do_info = $this->m_common->customeQuery("select so.customer_id from tbl_delivery_orders doo 
    LEFT JOIN tbl_sales_orders so on so.o_id=doo.o_id
    where doo.is_active=1 and doo.do_id=" . $do_id[0]['do_id']);
                $customer_id =$do_info[0]['customer_id'];
                $challan_code =explode('/', $do_id[0]['dc_no']);
                $challan_code =(int)$challan_code[3];
                $code = $this->m_common->get_row_array('tbl_delivery_challan_code', array('challan_code' => $challan_code, 'customer_id' => $customer_id), '*', 'customer_id', '1', 'id', 'desc');
                if (!empty($code))
                    $this->m_common->delete_row('tbl_delivery_challan_code', array('id' => $code[0]['id']));
                $delivery_challan_info = $do_id;
                //$delivery_challan_products = $this->m_common->get_row_array('tbl_delivery_challan_details', array('dc_id' => $id), '*');
                $dcd_sql="select * from tbl_delivery_challan_details dcd left join tbl_sales_products tsp on dcd.s_item_id=tsp.product_id where dcd.dc_id=$id";
                $delivery_challan_products=$this->m_common->customeQuery($dcd_sql);
                

                foreach ($delivery_challan_products as $c_product){
                    if($c_product['product_name']!="Water"){
                        $delivery_order_products=array();
                        $delivery_order_product=$this->m_common->get_row_array('tbl_delivery_order_details', array('do_id' => $delivery_challan_info[0]['do_id'], 's_item_id' => $c_product['s_item_id']), '*');
                        $delivery_quanity = $delivery_order_product[0]['delivery_quantity']-$c_product['quantity'];
                        $this->m_common->update_row('tbl_delivery_order_details', array('do_id' => $delivery_challan_info[0]['do_id'], 's_item_id' => $c_product['s_item_id']), array('delivery_quantity' => $delivery_quanity));
                    }
                }
                $this->m_common->update_row('tbl_delivery_challan_details', array('dc_id' => $id), array('is_active' => 0));
                
                $this->db->trans_complete();
                
                if($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                }   
                redirect_with_msg('delivery_challans/index', 'Successfully Deleted');
                
           }catch(UserException $error){
                $this->db->trans_rollback();            
                redirect_with_msg('delivery_challans/index', 'Something Went Wrong');
           }      
        } else {
            redirect_with_msg('delivery_challans/index', 'Please click on delete button');
        }
    }

    function get_delivery_order_item_() {
        $branch_id = $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
        $do_id = $this->input->post('do_id');
        $data['branch_info']=$this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
        // $data['delivery_info']=$this->m_common->get_row_array('tbl_delivery_orders',array('do_id'=>$do_id),'*');
        $do_sql = 'select do.*,c.c_short_name,c.id from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id where  do.do_id=' . $do_id;
        $data['delivery_info'] = $this->m_common->customeQuery($do_sql);

        $sql = "select d.*,i.product_name,i.measurement_unit from tbl_delivery_order_details d left join tbl_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and d.do_id=" . $do_id;
        $data['order_products'] = $this->m_common->customeQuery($sql);

        foreach ($data['order_products'] as $key => $value) {
            $p_statement = array();
            $p_sql = "select sum(production_qty) as total_production_qty from tbl_production_statement_details  where is_active=1 and product_id=" . $value['s_item_id'] . " and do_id=" . $do_id;
            $p_statement = $this->m_common->customeQuery($p_sql);
            if (!empty($p_statement)) {
                $data['order_products'][$key]['production_qty'] = $p_statement[0]['total_production_qty'];
            } else {
                $data['order_products'][$key]['production_qty'] = '';
            }
        }

        $sql = "select d.*,sod.remark,i.product_name,i.measurement_unit from tbl_delivery_order_details d 
left join tbl_sales_products i on d.s_item_id=i.product_id
left JOIN tbl_delivery_orders doo on doo.do_id=d.do_id
LEFT JOIN tbl_sales_orders so on so.o_id=doo.o_id
LEFT JOIN tbl_sales_order_details sod on so.o_id=sod.o_id 
where (d.delivery_status='Pending' or d.delivery_status='Partially Delivered') and d.is_active=1 and d.do_id=" . $do_id . "  group by d.do_details_id";
        $data['item_list'] = $this->m_common->customeQuery($sql);
        //$data['order_code']=$this->m_common->get_row_array('tbl_delivery_challan_code',array('customer_id'=>$data['delivery_info'][0]['id']),'*','',1,'id','DESC');
        $data['order_code'] = $this->m_common->get_row_array('tbl_delivery_challan_code', array('customer_id' => $data['delivery_info'][0]['id'], 'unit_id' => $branch_id), '*', '', 1, 'id', 'DESC');
        $te=$this->m_common->get_row_array('tbl_sales_products',array('product_name'=>"Water"),'*');
        $data['water_info']=$this->m_common->get_row_array('tbl_sales_products',array('product_name'=>"Water"),'*');
        echo json_encode($data);
    }

    function get_delivery_order_item() {
        $branch_id = $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
        $c_id = $this->input->post('c_id');
        // $data['delivery_info']=$this->m_common->get_row_array('tbl_delivery_orders',array('do_id'=>$do_id),'*');
        $do_sql = 'select do.*,c.c_short_name,c.id from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id where c.id=' . $c_id;
        $data['delivery_info'] = $this->m_common->customeQuery($do_sql);

        $sql = "select d.*,do.delivery_no,i.product_name,i.measurement_unit from tbl_delivery_order_details d join tbl_delivery_orders do on d.do_id=do.do_id join tbl_sales_orders so on so.o_id=do.o_id left join tbl_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and so.customer_id=" . $c_id;
        $data['order_products'] = $this->m_common->customeQuery($sql);

        foreach ($data['order_products'] as $key => $value) {
            $p_statement = array();
            $p_sql = "select sum(production_qty) as total_production_qty from tbl_production_statement_details  where product_id=" . $value['s_item_id'] . " and do_id=" . $value['do_id'];
            $p_statement = $this->m_common->customeQuery($p_sql);
            if (!empty($p_statement)) {
                $data['order_products'][$key]['production_qty'] = $p_statement[0]['total_production_qty'];
            } else {
                $data['order_products'][$key]['production_qty'] = '';
            }
        }

        $sql = "select d.*,doo.delivery_no,sod.remark,i.product_name,i.measurement_unit from tbl_delivery_order_details d 
left join tbl_sales_products i on d.s_item_id=i.product_id
left join tbl_delivery_orders doo on doo.do_id=d.do_id
left join tbl_sales_orders so on so.o_id=doo.o_id
left join tbl_sales_order_details sod on so.o_id=sod.o_id 
where (d.delivery_status='Pending' or d.delivery_status='Partially Delivered') and d.is_active=1 and so.customer_id=" . $c_id . "  group by d.do_details_id";
        $data['item_list'] = $this->m_common->customeQuery($sql);
        //$data['order_code']=$this->m_common->get_row_array('tbl_delivery_challan_code',array('customer_id'=>$data['delivery_info'][0]['id']),'*','',1,'id','DESC');
        $data['order_code'] = $this->m_common->get_row_array('tbl_delivery_challan_code', array('customer_id' => $data['delivery_info'][0]['id'], 'unit_id' => $branch_id), '*', '', 1, 'id', 'DESC');
        echo json_encode($data);
    }

//   Add by jubayer  ///

    function add_extra_delivery_challan() {
        $branch_id = $this->session->userdata('companyId');
//        $this->menu = 'sales';
//        $this->sub_menu = 'sale';
//        $this->sub_inner_menu = 'delivery_challan';

        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'delivery_challan';


        $this->titlebackend("Quotation Information");
        $sql = "select do.*,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and do.status!='Delivered' and do.unit_id=" . $branch_id;
        //$sql="select do.*,c.id as c_id,c.c_name,c.c_short_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.is_active=1 and do.status!='Delivered' and do.unit_id=".$branch_id." group by c.id";
        $data['delivery_orders'] = $this->m_common->customeQuery($sql);
        //$data['customers']=$this->m_common->customeQuery($sql);
        $data['drivers'] = $this->m_common->get_row_array('tbl_driver', array('is_active' => 1), '*');
        $data['helpers'] = $this->m_common->get_row_array('tbl_helper', array('is_active' => 1), '*');
        $data['trucks'] = $this->m_common->get_row_array('tbl_truck', array('is_active' => 1), '*');
        $this->load->view('delivery_challans/v_add_extra_delivery_challan', $data);
    }

}
