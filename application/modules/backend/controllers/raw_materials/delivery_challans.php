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

        $this->menu = 'trading';
        $this->sub_menu = 'rm_challan';
        $this->sub_inner_menu = 'delivery_challan';

        $this->titlebackend("Delivery Challan");
        // $data['sale_challan']=$this->m_common->get_row_array('rm_sales_sale_challan
        // $sql="select dc.*,do.delivery_no,c.c_name,c.c_short_name from rm_delivery_challans dc left join rm_delivery_orders do on dc.do_id=do.do_id left join rm_sales_orders so on do.o_id=so.o_id left join rm_sales_quotation q on so.q_id=q.q_id left join rm_customers c on q.customer_id=c.id where dc.is_active=1 order by dc_id DESC";
      //  $sql = "select dc.*,do.delivery_no,c.c_name,c.c_short_name from rm_delivery_challans dc left join rm_delivery_orders do on dc.do_id=do.do_id left join rm_sales_orders so on do.o_id=so.o_id left join rm_customers c on so.customer_id=c.id where dc.is_active=1 and dc.delivery_challan_date>='2020-10-01' and dc.unit_id=" . $branch_id . " order by dc_id DESC";//27-12-2020
        // $sql = "select dc.*,do.delivery_no,c.c_name,c.c_short_name,tdcd.bill_status from rm_delivery_challans dc 
        // left join rm_delivery_challan_details tdcd on tdcd.dc_id=dc.dc_id 
        // left join rm_delivery_orders do on dc.do_id=do.do_id 
        // left join rm_sales_orders so on do.o_id=so.o_id 
        // left join rm_customers c on so.customer_id=c.id where dc.is_active=1 and dc.delivery_challan_date>='2020-10-01' and dc.unit_id=" . $branch_id . " order by dc_id DESC";
        // $data['delivery_challans'] = $this->m_common->customeQuery($sql);
        $this->load->view('raw_materials/delivery_challans/v_delivery_challan', $data);
    }

    public function delv_challan_list(){
        $branch_id = $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
           // POST data
           $postData = $this->input->post();
           $user_id =$this->session->userdata('user_id');
           $userData =$this->m_common->get_row_array('users',array('id' =>$user_id),'*');
           $this->role =checkUserPermission(18,122, $userData);
           
           $this->load->library('DataTables');
           $this->datatables->setDatabase($this->db->database);
           $aTable = 'rm_delivery_challans';
           $aColumns = array('rm_delivery_challans.dc_id','rm_delivery_challans.delivery_challan_date','rm_delivery_challans.dc_no','rm_delivery_challans.manual_dc_no','rm_delivery_challan_details.quantity','tbl_customers.c_name','rm_delivery_challans.status','rm_delivery_challan_details.bill_status','rm_items.item_name','tbl_measurement_unit.meas_unit');
           $joinTable = array('rm_delivery_challan_details','tbl_customers','rm_items','tbl_measurement_unit');
           $JoinCriteria = array('rm_delivery_challan_details.dc_id=rm_delivery_challans.dc_id','rm_delivery_challans.customer_id=tbl_customers.id','rm_delivery_challan_details.s_item_id=rm_items.id','tbl_measurement_unit.id=rm_items.mu_id');
           $joinStatus = array('','left','left','left','left','left');
         //  $where = 'rm_delivery_challans.unit_id='.$branch_id;
         //  $where['rm_delivery_challans.unit_id']=$branch_id;
           $where['rm_delivery_challans.delivery_location']='Yard';
           $where['rm_delivery_challans.is_active']=1;
           $records = $this->datatables->get_json($aTable, $aColumns,$joinTable,$JoinCriteria,$joinStatus,$where);
          //echo $this->db->last_query();exit;
           $data = array();
           foreach($records['data'] as $key=>$record ){
      
               $data[$key] = array( 
                  "dc_id"=>$record->dc_id,
                  "delivery_challan_date"=>$record->delivery_challan_date,
                  "dc_no"=>$record->dc_no,
                  "manual_dc_no"=>$record->manual_dc_no,
                  "quantity"=>$record->quantity,
                  "c_name"=>$record->c_name,
                  "item_name"=>$record->item_name,
                  "meas_unit"=>$record->meas_unit,
                  
                  "project_name"=>'',
                  "status"=>$record->status,
                ); 
                $action='';
                if($record->status=="Pending"){
                    if (in_array(4,$this->role)) {
                        $action.='<a href="'.site_url('raw_materials/delivery_challans/details_delivery_challan/'.$record->dc_id).'"><button class="btn btn-sm btn-success" >View</button></button></a>';
                    }
                    if (in_array(3,$this->role) || (in_array($userData[0]['user_type'],array(1,3)))){
                        $action.='<a href="'.site_url('raw_materials/delivery_challans/edit_delivery_challan/'.$record->dc_id).'"><button class="btn btn-sm btn-success" >Edit</a>';
                    }
                    
                    if(in_array(2,$this->role)){
                        $action.='<a href="'.site_url('raw_materials/delivery_challans/approve_delivery_challan/'.$record->dc_id).'"><button class="btn btn-sm btn-success">Approve</i></a>';
                    }
                    
                    if(in_array(5,$this->role)){
                        $action.='<button onclick="delete_row(\''.site_url('raw_materials/delivery_challans/delete_delivery_challan/'.$record->dc_id).'\')" class="btn btn-sm btn-danger">Delete</button>';
                    }
                
                
                
                
                }else{
                    if (in_array(4, $this->role)) {
                        $action.='<a href="'.site_url('raw_materials/delivery_challans/details_delivery_challan/'.$record->dc_id).'"><button class="btn btn-sm btn-success" >View</button></button></a>';
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

        $this->menu = 'trading';
        $this->sub_menu = 'trading';
        $this->sub_inner_menu = 'delivery_challan';


        $this->titlebackend("Quotation Information");
        $c_sql="select c.* from tbl_customers c where c.customer_category='Raw Material' ";
        $data['customers']=$this->m_common->customeQuery($c_sql);
        
        $data['drivers'] = $this->m_common->get_row_array('tbl_driver', array('is_active' => 1,'transport_type'=>"Truck"), '*');
        $data['helpers'] = $this->m_common->get_row_array('tbl_helper', array('is_active' => 1), '*');
        $data['trucks'] = $this->m_common->get_row_array('tbl_truck', array('is_active' => 1,'transport_type'=>"Truck"), '*');
        $data['transport_companies']=$this->m_common->get_row_array('rm_transport_company',array('is_active'=>1,'transport_type'=>"Truck"),'*');
        $this->load->view('raw_materials/delivery_challans/v_add_delivery_challan', $data);
    }

    function add_delivery_challan_customer() {
        $branch_id = $this->session->userdata('companyId');
//        $this->menu = 'sales';
//        $this->sub_menu = 'sale';
//        $this->sub_inner_menu = 'delivery_challan';

        $this->menu = 'trading';
        $this->sub_menu = 'trading';
        $this->sub_inner_menu = 'delivery_challan';


        $this->titlebackend("Quotation Information");
        //$sql="select do.*,c.c_name,c.c_short_name from rm_delivery_orders do left join rm_sales_orders so on do.o_id=so.o_id left join rm_sales_quotation q on so.q_id=q.q_id left join  rm_customers c on q.customer_id=c.id where do.is_active=1 and do.status!='Delivered' and do.unit_id=".$branch_id;
        $sql = "select do.*,c.id as c_id,c.c_name,c.c_short_name from rm_delivery_orders do left join rm_sales_orders so on do.o_id=so.o_id left join rm_sales_quotation q on so.q_id=q.q_id left join  rm_customers c on q.customer_id=c.id where do.is_active=1 and do.status!='Delivered' and do.unit_id=" . $branch_id . " group by c.id";
        // $data['delivery_orders']=$this->m_common->customeQuery($sql);
        $data['customers'] = $this->m_common->customeQuery($sql);
        $data['drivers'] = $this->m_common->get_row_array('tbl_driver', array('is_active' => 1), '*');
        $data['helpers'] = $this->m_common->get_row_array('tbl_helper', array('is_active' => 1), '*');
        $data['trucks'] = $this->m_common->get_row_array('tbl_truck', array('is_active' => 1), '*');
        $this->load->view('raw_materials/delivery_challans/v_add_delivery_challan', $data);
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
                        redirect_with_msg('raw_materials/delivery_challans/add_delivery_challan', 'Please Select Product');
                    }

                    
                    if (!empty($postData['customer_id'])){
                        $insertData['customer_id'] = $postData['customer_id'];
                    }
                    
                   
                    if(!empty($postData['challan_time'])){
                        $insertData['challan_time'] = $postData['challan_time'];
                    }


                    

        
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

                    
                    
                    if (!empty($postData['shipping_address'])) {
                        $insertData['shipping_address'] = $postData['shipping_address'];
                    }
                    if (!empty($postData['shipping_email'])) {
                        $insertData['shipping_email'] = $postData['shipping_email'];
                    }

                    if (!empty($postData['total_amount'])) {
                        $insertData['total_amount'] = $postData['total_amount'];
                    }

                    if(!empty($postData['driver_id'])){
                        $insertData['driver_id'] = $postData['driver_id'];
                        $driver_info=$this->m_common->get_row_array('tbl_driver',array('driver_id'=>$postData['driver_id']),'*');
                        $driver_name=$driver_info[0]['driver_name'];
                    }
                    
                    if (!empty($postData['driver_name'])){
                        $driver_name=$postData['driver_name'];
                    }
                                        
                    if (!empty($postData['helper_id'])) {
                        $insertData['helper_id'] = $postData['helper_id'];
                        $helper_info=$this->m_common->get_row_array('tbl_helper',array('helper_id'=>$postData['helper_id']),'*');
                        $helper_name=$helper_info[0]['helper_name'];
                    }
                    
                    if (!empty($postData['helper_name'])){
                        $helper_name=$postData['helper_name'];
                    }
                    
                    
                    if (!empty($postData['truck_id'])) {
                        $insertData['truck_id'] = $postData['truck_id'];
                        $truck_info=$this->m_common->get_row_array('tbl_truck',array('truck_id'=>$postData['truck_id']),'*');
                        $truck_no=$truck_info[0]['truck_no'];
                    }
                    
                    
                    if (!empty($postData['truck_no'])){
                        $truck_no=$postData['truck_no'];
                    }
                    
                    
                    

                    if (!empty($postData['transport_type'])) {
                        $insertData['transport_type'] = $postData['transport_type'];
                    }
                    
                    if (!empty($postData['t_company_id'])) {
                        $insertData['t_company_id'] = $postData['t_company_id'];
                    }
                    
                    if(!empty($postData['manual_dc_no'])){
                        $insertData['manual_dc_no'] = $postData['manual_dc_no'];
                    }
                    
                    $insertData['driver_name'] =$driver_name;
                    $insertData['helper_name'] =$helper_name;
                    $insertData['truck_no'] =$truck_no;
                    
                    
                    $insertData['delivery_location'] ='Yard';
                    $insertData['created_by'] =$user_id;
                    
                    $insertData['unit_id'] =$branch_id;
                    $insertData['is_active'] =1;
                    $insertData['status'] ='Pending';

                    $insertData['challan_date_time'] =date('Y-m-d H:i:s');
                    $insertData['created_date'] = date('Y-m-d');
                    
                    

                    $this->db->trans_start();
                    
                    $result = $this->m_common->insert_row('rm_delivery_challans',$insertData);
                    if (!empty($result)) {
                        //$this->m_common->insert_row('rm_delivery_challan_code', array('challan_code' => $postData['challan_code'], 'customer_id' => $postData['customer_id'], 'unit_id' => $branch_id));
                        // $this->m_common->update_row('rm_delivery_orders', array('do_id' =>$do_id),array('status'=>"Delivered"));
                        foreach ($postData['s_item_id'] as $key => $each) {
                            if (in_array($key+1, $postData['select_product'])) {
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
                                
                                
                                if(!empty($postData['lc_details_id'][$key])){
                                    $insertData1['lc_details_id'] = $postData['lc_details_id'][$key];
                                    
                                }
                                
                                if(!empty($postData['do_details_id'][$key])){
                                    $insertData1['do_details_id'] = $postData['do_details_id'][$key];
                                    
                                }

                                if(!empty($postData['do_qty'][$key])){
                                    $insertData1['do_qty']=$postData['do_qty'][$key];
                                }
                                
                                if (!empty($postData['unit_price'][$key])) {
                                    $insertData1['unit_price'] = $postData['unit_price'][$key];
                                }

                                
                                $insertData1['amount'] =$postData['unit_price'][$key]*$postData['quantity'][$key];

                                $this->m_common->insert_row('rm_delivery_challan_details', $insertData1);
                            }
                        }
                        // qty update for do
                       // $delivery_challan_info = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $result), '*');
                      //  $delivery_challan_products = $this->m_common->get_row_array('rm_delivery_challan_details', array('dc_id' => $result), '*');
                        $dcd_sql="select * from rm_delivery_challan_details dcd left join rm_items tsp on dcd.s_item_id=tsp.id where dcd.dc_id=$result";
                        $delivery_challan_products=$this->m_common->customeQuery($dcd_sql);
                        if(!empty($result)){
                            
                            foreach ($delivery_challan_products as $c_product){
                               
                                    $delivery_order_products = array();
                                    $delivery_order_product = $this->m_common->get_row_array('rm_delivery_orders_details', array('do_details_id' => $c_product['do_details_id'],'s_item_id'=>$c_product['s_item_id']),'*');
                                    $delivery_quanity = $delivery_order_product[0]['delivery_quantity']+$c_product['quantity'];
                                    $this->m_common->update_row('rm_delivery_orders_details', array('do_details_id' => $c_product['do_details_id'], 's_item_id' => $c_product['s_item_id']), array('delivery_quantity' => $delivery_quanity));
                                
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
                    redirect_with_msg('raw_materials/delivery_challans', 'Successfully Inserted');
            }catch(UserException $error){
                $this->db->trans_rollback();               
                redirect_with_msg('raw_materials/delivery_challans', 'Something went wrong');
            }        
            
        } else {
            redirect_with_msg('raw_materials/delivery_challans/add_delivery_challan', 'Please fill the form and submit');
        }
    }

    function edit_delivery_challan($id) {
        $branch_id = $this->session->userdata('companyId');
        
        $this->menu = 'Trading';
        $this->sub_menu = 'delivery_challan';
        $this->sub_inner_menu = 'delivery_challan';


        $this->titlebackend("Delivery Challan Information");
        
        $c_sql="select c.* from tbl_customers c where c.customer_category='Raw Material' ";
        $data['customers']=$this->m_common->customeQuery($c_sql);
        
       
        $data['delivery_challan_info'] = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $id), '*');
        // $sql="select d.*,item.s_item_name from rm_delivery_challan_details d left join rm_sales_items item on d.s_item_id=item.s_item_id where d.is_active=1";
        $sql = "select d.*,do.delivery_no,sp.item_name,sp.origin,sp.item_grade,tmu.meas_unit from rm_delivery_challan_details d 
left join rm_delivery_challans as dc on dc.dc_id=d.dc_id
left join rm_delivery_orders_details dod on d.do_details_id=dod.do_details_id
left join rm_delivery_orders do on dod.do_id=do.do_id
left join rm_items sp on d.s_item_id=sp.id
left join tbl_measurement_unit tmu on sp.mu_id=tmu.id 
where d.is_active=1 and d.dc_id=".$id;
        
        $data['delivery_challan_details_info'] = $this->m_common->customeQuery($sql);        
        $data['drivers'] = $this->m_common->get_row_array('tbl_driver', array('is_active' => 1,'transport_type'=>"Truck"), '*');
        $data['helpers'] = $this->m_common->get_row_array('tbl_helper', array('is_active' => 1), '*');
        $data['trucks'] = $this->m_common->get_row_array('tbl_truck', array('is_active' => 1,'transport_type'=>"Truck"), '*');
        $data['transport_companies']=$this->m_common->get_row_array('rm_transport_company',array('is_active'=>1,'transport_type'=>"Truck"),'*');
        $this->load->view('raw_materials/delivery_challans/v_edit_delivery_challan', $data);
    }

    function edit_delivery_challan_action($dc_id) {
        $user_id=$this->session->userdata('user_id');
        $postData=$this->input->post();
        if(!empty($postData)){
            $pre_info = $this->m_common->get_row_array('rm_delivery_challans', array('do_id' => $do_id), '*');
            $insertData = array();

            if(empty($postData['select_product'])){
                redirect_with_msg('raw_materials/delivery_challans/edit_delivery_challan_action/' . $dc_id, 'Please Select Product');
            }

            
            if(!empty($postData['customer_id'])){
                $insertData['customer_id'] = $postData['customer_id'];
            }
            
            if(!empty($postData['delivery_challan_date'])){
                $insertData['delivery_challan_date'] = date('Y-m-d', strtotime($postData['delivery_challan_date']));
            }

            if (!empty($postData['challan_time'])) {
                $insertData['challan_time'] = $postData['challan_time'];
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

           
            if (!empty($postData['shipping_address'])) {
                $insertData['shipping_address'] = $postData['shipping_address'];
            }
            if (!empty($postData['shipping_email'])) {
                $insertData['shipping_email'] = $postData['shipping_email'];
            }

            if (!empty($postData['total_amount'])) {
                $insertData['total_amount'] = $postData['total_amount'];
            }

            
            if(!empty($postData['driver_id'])){
                $insertData['driver_id'] = $postData['driver_id'];
                $driver_info=$this->m_common->get_row_array('tbl_driver',array('driver_id'=>$postData['driver_id']),'*');
                $driver_name=$driver_info[0]['driver_name'];
            }

            if (!empty($postData['driver_name'])){
                $driver_name=$postData['driver_name'];
            }

            if (!empty($postData['helper_id'])) {
                $insertData['helper_id'] = $postData['helper_id'];
                $helper_info=$this->m_common->get_row_array('tbl_helper',array('helper_id'=>$postData['helper_id']),'*');
                $helper_name=$helper_info[0]['helper_name'];
            }

            if (!empty($postData['helper_name'])){
                $helper_name=$postData['helper_name'];
            }


            if (!empty($postData['truck_id'])) {
                $insertData['truck_id'] = $postData['truck_id'];
                $truck_info=$this->m_common->get_row_array('tbl_truck',array('truck_id'=>$postData['truck_id']),'*');
                $truck_no=$truck_info[0]['truck_no'];
            }


            if (!empty($postData['truck_no'])){
                $truck_no=$postData['truck_no'];
            }




            if (!empty($postData['transport_type'])) {
                $insertData['transport_type'] = $postData['transport_type'];
            }

            if(!empty($postData['t_company_id'])){
                $insertData['t_company_id'] = $postData['t_company_id'];
            }

            if(!empty($postData['manual_dc_no'])){
                $insertData['manual_dc_no'] = $postData['manual_dc_no'];
            }
            
            $insertData['driver_name'] =$driver_name;
            $insertData['helper_name'] =$helper_name;
            $insertData['truck_no'] =$truck_no;
            $insertData['updated_by'] =$user_id;

            $this->db->trans_start();
            
            $result = $this->m_common->update_row('rm_delivery_challans', array('dc_id' => $dc_id), $insertData);
            if($result>=0){
                
                //$exists = $this->m_common->get_row_array('rm_delivery_challan_details', array('dc_id' => $dc_id), '*');
                //$this->m_common->delete_row('rm_delivery_challan_details',array('dc_id'=>$dc_id));
                foreach ($postData['s_item_id'] as $key => $each) {
                    if (in_array($key+1, $postData['select_product'])) {
                        $exists=array();
                        $exists = $this->m_common->get_row_array('rm_delivery_challan_details', array('do_details_id' =>$postData['do_details_id'][$key]), '*');
                        
                        $insertData1 = array();
                        $insertData1['dc_id'] = $dc_id;
                        $insertData1['s_item_id'] = $each;
                        $insertData1['is_active'] = 1;
                       // $insertData1['bill_status'] = 'Pending';
                       // $insertData1['receive_status'] = 'Pending';
                        if (empty($each)) {
                            continue;
                        }
                        if(!empty($postData['quantity'][$key])){
                            $insertData1['quantity'] = $postData['quantity'][$key];
                            $insertData1['challan_qty'] = $postData['quantity'][$key];
                        }

                        
                        if(!empty($postData['lc_details_id'][$key])){
                            $insertData1['lc_details_id'] = $postData['lc_details_id'][$key];

                        }
                        
                        
                        if(!empty($postData['do_details_id'][$key])){
                            $insertData1['do_details_id']=$postData['do_details_id'][$key];

                        }
                        
                        
                        if(!empty($postData['do_qty'][$key])){
                            $insertData1['do_qty']=$postData['do_qty'][$key];
                        }

                        
                        if(!empty($postData['unit_price'][$key])){
                            $insertData1['unit_price'] = $postData['unit_price'][$key];
                        }

                        
                        
                        $insertData1['amount']=$postData['unit_price'][$key]*$postData['quantity'][$key];

                        $this->m_common->update_row('rm_delivery_challan_details',array('dc_details_id'=>$postData['dc_details_id'][$key]),$insertData1);

                        $d=array();
                        $sql = "select d.* 
from rm_delivery_orders_details d  where d.is_active=1 and d.s_item_id=$each and d.do_details_id=" . $postData['do_details_id'][$key];
                        $d=$this->m_common->customeQuery($sql);
                        if(!empty($d)){
                            $qty = $d[0]['delivery_quantity'] - $exists[0]['quantity'];
                            $qty = $qty + $postData['quantity'][$key];
                            $this->m_common->update_row('rm_delivery_orders_details', array('do_details_id'=>$d[0]['do_details_id']),array('delivery_quantity'=> $qty));
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
            
            
            redirect_with_msg('raw_materials/delivery_challans', 'Successfully Updated');
            
        } else {

            redirect_with_msg('raw_materials/delivery_challans/edit_delivery_challan_action/' . $dc_id, 'Please fill the form first');
        }
    }

    function details_delivery_challan($id, $print = false) {
        $branch_id = $this->session->userdata('companyId');
        
        $this->menu = 'Trading';
        $this->sub_menu = 'delivery_challan';
        $this->sub_inner_menu = 'delivery_challan';


        $this->titlebackend("Delivery Challan Information");
        
        $c_sql="select c.* from tbl_customers c where c.customer_category='Raw Material' ";
        $data['customers']=$this->m_common->customeQuery($c_sql);
        
       
        
        // $sql="select d.*,item.s_item_name from rm_delivery_challan_details d left join rm_sales_items item on d.s_item_id=item.s_item_id where d.is_active=1";
        $sql = "select d.*,do.delivery_no,sp.item_name,sp.origin,sp.item_grade,tmu.meas_unit from rm_delivery_challan_details d 
left join rm_delivery_challans as dc on dc.dc_id=d.dc_id
left join rm_delivery_orders_details dod on d.do_details_id=dod.do_details_id
left join rm_delivery_orders do on dod.do_id=do.do_id
left join rm_items sp on d.s_item_id=sp.id
left join tbl_measurement_unit tmu on sp.mu_id=tmu.id 
where d.is_active=1 and d.dc_id=".$id;
        
        $data['delivery_challan_details_info'] = $this->m_common->customeQuery($sql);        
        $data['drivers'] = $this->m_common->get_row_array('tbl_driver', array('is_active' => 1,'transport_type'=>"Truck"),'*');
        $data['helpers'] = $this->m_common->get_row_array('tbl_helper', array('is_active' => 1), '*');
        $data['trucks'] = $this->m_common->get_row_array('tbl_truck', array('is_active' => 1,'transport_type'=>"Truck"),'*');
        $data['transport_companies']=$this->m_common->get_row_array('rm_transport_company',array('is_active'=>1,'transport_type'=>"Truck"),'*');
        
        
        if ($print == false) {
            $data['delivery_challan_info'] = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $id), '*');
            $this->load->view('raw_materials/delivery_challans/v_details_delivery_challan', $data);
        } else {
            
            $dc_sql = "select dc.*,c.id,c.c_short_name,c.c_name,c.c_contact_person,c.c_mobile_no,c.c_contact_address,td.contact_no as d_contact_no,th.contact_no as h_contact_no from rm_delivery_challans dc left join tbl_customers c on dc.customer_id=c.id left join tbl_driver td on dc.driver_id=td.driver_id left join tbl_helper th on dc.helper_id=th.helper_id left join tbl_truck tt on dc.truck_id=tt.truck_id where dc.dc_id=" . $id;
            $delivery_challan_info= $this->m_common->customeQuery($dc_sql);
            
            
            if(empty($delivery_challan_info[0]['dc_no'])){
                $branch_info=$this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
                $branch = $branch_info[0]['short_name'];
            //    $order_code = $this->m_common->get_row_array('rm_delivery_challan_code', array('customer_id' => $data['delivery_challan_info'][0]['id'], 'unit_id' => $branch_id), '*', '', 1, 'id', 'DESC');
               $order_code = $this->m_common->get_row_array('rm_delivery_challans', array('customer_id' =>$delivery_challan_info[0]['customer_id'],'delivery_location'=>"Yard"),'*');    
                if (!empty($order_code)){
                    $item_id = count($order_code);
                } else {
                    $item_id = "";
                }
                if ($item_id != '') {
                    if ($item_id > 999) {
                        //item_sl_no = item_id;
                        $item_sl_no ='CH/'.$delivery_challan_info[0]['c_short_name']. '/'.date('y').'/'.$item_id;
                    }else if ($item_id > 99) {
                        $item_sl_no ='CH/'.$delivery_challan_info[0]['c_short_name']. '/'.date('y/')."0".$item_id;
                    }else if ($item_id > 9){
                        $item_sl_no ='CH/'.$delivery_challan_info[0]['c_short_name']. '/'.date('y/')."00".$item_id;
                    }else{
                        $item_sl_no = 'CH/'.$delivery_challan_info[0]['c_short_name']. '/'.date('y/')."000".$item_id;
                    }
                }else{
                    $item_id = 1;
                    $item_sl_no = 'CH/'.$delivery_challan_info[0]['c_short_name']. '/'.date('y/')."0001";
                }


              $print_date_time=date('Y-m-d H:i:s');  
              if(empty($delivery_challan_info[0]['print_date_time'])){
                    $this->m_common->update_row('rm_delivery_challans',array('dc_id' =>$id),array('dc_no'=>$item_sl_no,'print_date_time'=>$print_date_time)); 
              }else{
                    $this->m_common->update_row('rm_delivery_challans',array('dc_id' =>$id),array('dc_no'=>$item_sl_no));   
              }
                //$this->m_common->insert_row('rm_delivery_challan_code',array('challan_code'=>$item_id,'customer_id'=>$data['delivery_challan_info'][0]['id'],'unit_id'=>$branch_id)); 
            }
            
            
            $dc1_sql = "select dc.*,c.id,c.c_short_name,c.c_name,c.c_contact_person,c.c_mobile_no,c.c_contact_address,td.contact_no as d_contact_no,th.contact_no as h_contact_no from rm_delivery_challans dc left join tbl_customers c on dc.customer_id=c.id left join tbl_driver td on dc.driver_id=td.driver_id left join tbl_helper th on dc.helper_id=th.helper_id left join tbl_truck tt on dc.truck_id=tt.truck_id where dc.dc_id=" . $id;
            $data['delivery_challan_info'] = $this->m_common->customeQuery($dc1_sql);
            
            $html = $this->load->view('raw_materials/delivery_challans/print_delivery_challan', $data, true);
            echo $html;
            exit;
        }
    }

    function approve_delivery_challan($id) {
        $this->menu = 'Trading';
        $this->sub_menu = 'delivery_challan';
        $this->titlebackend("Delivery Challan Information");
        try{
            $this->db->trans_start();
            $delivery_challan_info = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $id), '*');
           // $delivery_challan_products = $this->m_common->get_row_array('rm_delivery_challan_details', array('dc_id' => $id), '*');
            $dcd_sql="select * from rm_delivery_challan_details dcd left join rm_items tsp on dcd.s_item_id=tsp.id where dcd.dc_id=$id";
            $delivery_challan_products=$this->m_common->customeQuery($dcd_sql);
            $result = $this->m_common->update_row('rm_delivery_challans', array('dc_id' => $id), array('status' => "Approved"));
            if(!empty($result)){
                foreach ($delivery_challan_products as $c_product) {
                    
                        $delivery_order_products=array();
                        $delivery_order_product =$this->m_common->get_row_array('rm_delivery_orders_details', array('do_details_id' =>$c_product['do_details_id'],'s_item_id' =>$c_product['s_item_id']),'*');
                        $delivery_quanity=$delivery_order_product[0]['delivery_quantity']; // + $c_product['quantity'];
                        if($delivery_quanity==$delivery_order_product[0]['quantity']){
                            $status = "Delivered";
                        } else {
                            $status = "Partially Delivered";
                        }
                        $this->m_common->update_row('rm_delivery_orders_details',array('do_details_id' => $c_product['do_details_id'],'s_item_id'=>$c_product['s_item_id']),array('delivery_status'=>$status));
                        
                        
                        
                        $delivery_order_products = $this->m_common->get_row_array('rm_delivery_orders_details',array('do_id'=>$delivery_order_product[0]['do_id']),'*');
                        $j = 0;
                        foreach ($delivery_order_products as $delivery_product) {
                            if ($delivery_product['delivery_status'] != "Delivered") {
                                $j = 1;
                            }
                        }

                        if($j == 1){
                            $this->m_common->update_row('rm_delivery_orders', array('do_id'=>$delivery_order_product[0]['do_id']),array('status' =>"Partially Delivered"));
                        }else{
                            $this->m_common->update_row('rm_delivery_orders', array('do_id'=>$delivery_order_product[0]['do_id']),array('status' =>"Delivered"));
                        } 


                }
            }
            
            
            $this->db->trans_complete();
                
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }   
            redirect_with_msg('raw_materials/delivery_challans/index', 'Successfully Approved');
        }catch(UserException $error){
            $this->db->trans_rollback();            
            redirect_with_msg('raw_materials/delivery_challans/index', 'Something Went Wrong');
        }      
    }
    
    function delivery_challan_partial_receive($id){
        $branch_id = $this->session->userdata('companyId');
        
        $this->menu='production';
        $this->sub_menu='production';
        $this->sub_inner_menu='delivery_challan';

        $this->titlebackend("Delivery Challan Information");
        $sql = "select do.*,c.c_name,c.c_short_name from rm_delivery_orders do left join rm_sales_orders so on do.o_id=so.o_id left join rm_sales_quotation q on so.q_id=q.q_id left join  rm_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Pending' or do.status='Partially Delivered' or do.status='Delivered') and do.unit_id=" . $branch_id;
        $data['delivery_orders'] = $this->m_common->customeQuery($sql);
        
        $data['delivery_challan_info'] = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $id), '*');
        // $sql="select d.*,item.s_item_name from rm_delivery_challan_details d left join rm_sales_items item on d.s_item_id=item.s_item_id where d.is_active=1";
        $sql = "select d.*,dc.do_id,sod.remark,sp.product_name,sp.measurement_unit from rm_delivery_challan_details d 
left join rm_delivery_challans as dc on dc.dc_id=d.dc_id
left JOIN rm_delivery_orders doo on doo.do_id=dc.do_id
LEFT JOIN rm_sales_orders so on so.o_id=doo.o_id
LEFT JOIN rm_sales_order_details sod on so.o_id=sod.o_id
left join rm_sales_products sp on d.s_item_id=sp.product_id where d.is_active=1 and d.dc_id=" . $id . " GROUP BY d.s_item_id";
        $data['delivery_challan_details_info'] = $this->m_common->customeQuery($sql);

        $sql ="select d.*,i.product_name,i.measurement_unit from rm_delivery_order_details d left join rm_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and d.do_id=" . $data['delivery_challan_info'][0]['do_id'];
        $data['order_products'] = $this->m_common->customeQuery($sql);

        $this->load->view('delivery_challans/v_delivery_challan_partial_receive', $data);
    }
    
    
    function delivery_challan_partial_receive_action($dc_id){
        $user_id=$this->session->userdata('user_id');
        $postData=$this->input->post();
        if(!empty($postData)){
            $pre_info=$this->m_common->get_row_array('rm_delivery_challans',array('do_id' =>$do_id),'*');
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
            
            $result = $this->m_common->update_row('rm_delivery_challans', array('dc_id' => $dc_id), $insertData);
            if ($result >= 0){
                
                $exists = $this->m_common->get_row_array('rm_delivery_challan_details',array('dc_id' =>$dc_id),'*');
                $this->m_common->delete_row('rm_delivery_challan_details', array('dc_id' => $dc_id));
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

                        $this->m_common->insert_row('rm_delivery_challan_details', $insertData1);

                        $sql = "select d.*,i.product_name,i.measurement_unit 
from rm_delivery_order_details d left join rm_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and d.s_item_id=$each and d.do_id=" . $do_id;
                        $d=$this->m_common->customeQuery($sql);
                        if(!empty($d)){
                            $qty=$d[0]['delivery_quantity']-$exists[0]['quantity'];
                            $qty=$qty+$postData['quantity'][$key];
                            $this->m_common->update_row('rm_delivery_order_details',array('do_details_id' =>$d[0]['do_details_id']),array('delivery_quantity' =>$qty));
                        }
                    
                }
                
            }
            
            
            $this->db->trans_complete();                
            if($this->db->trans_status()===FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }   
            
            
            redirect_with_msg('raw_materials/delivery_challans','Successfully Received');
            
        } else {

            redirect_with_msg('raw_materials/delivery_challans/edit_delivery_challan_action/'.$dc_id, 'Please fill the form first');
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
                
                $this->m_common->update_row('rm_delivery_challans', array('dc_id' => $id),array('remark'=>$remark,'status' => "Canceled"));
                $do_id = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $id), '*');
                $delivery_challan_info=$do_id;
                //$delivery_challan_products = $this->m_common->get_row_array('rm_delivery_challan_details', array('dc_id' => $id), '*');
                $dcd_sql="select * from rm_delivery_challan_details dcd left join rm_items tsp on dcd.s_item_id=tsp.id where dcd.dc_id=$id";
                $delivery_challan_products=$this->m_common->customeQuery($dcd_sql);

                foreach ($delivery_challan_products as $c_product) {
                    
                        $delivery_order_products=array();
                        $delivery_order_product=$this->m_common->get_row_array('rm_delivery_orders_details', array('do_details_id' =>$c_product['do_details_id'],'s_item_id' =>$c_product['s_item_id']),'*');
                        $delivery_quanity =$delivery_order_product[0]['delivery_quantity']-$c_product['quantity'];
                        $this->m_common->update_row('rm_delivery_orders_details', array('do_details_id' => $c_product['do_details_id'],'s_item_id'=>$c_product['s_item_id']),array('delivery_quantity'=>$delivery_quanity));
                    
                }




                $delivery_challan_info = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $id), '*');
                $delivery_challan_products = $this->m_common->get_row_array('rm_delivery_challan_details', array('dc_id' => $id), '*');
                $result = $this->m_common->update_row('rm_delivery_challans', array('dc_id' => $id), array('status' => "Canceled"));
                if (!empty($result)) {
                    foreach ($delivery_challan_products as $c_product){
                        $delivery_order_products = array();
                        $delivery_order_product = $this->m_common->get_row_array('rm_delivery_orders_details', array('do_details_id' => $c_product['do_details_id'], 's_item_id' =>$c_product['s_item_id']),'*');
                        $delivery_quanity = $delivery_order_product[0]['delivery_quantity']; // + $c_product['quantity'];
                        if ($delivery_quanity == $delivery_order_product[0]['quantity']) {
                            $status = "Delivered";
                        }else if($delivery_quanity==0){ 
                            $status = "Pending";
                        }else {
                            $status = "Partially Delivered";
                        }
                        $this->m_common->update_row('rm_delivery_orders_details',array('do_details_id'=>$c_product['do_details_id'],'s_item_id' =>$c_product['s_item_id']),array('delivery_status'=>$status));
                        
                        
                        $delivery_order_products = $this->m_common->get_row_array('rm_delivery_orders_details',array('do_id'=>$delivery_order_product[0]['do_id']),'*');
                        $j = 0;
                        foreach ($delivery_order_products as $delivery_product) {
                            if ($delivery_product['delivery_status'] != "Delivered") {
                                $j = 1;
                            }
                        }

                        if($j == 1){
                            $this->m_common->update_row('rm_delivery_orders', array('do_id'=>$delivery_order_product[0]['do_id']),array('status' =>"Partially Delivered"));
                        }else{
                            $this->m_common->update_row('rm_delivery_orders', array('do_id'=>$delivery_order_product[0]['do_id']),array('status' =>"Delivered"));
                        } 
                        
                    }
                }
               
                
                $this->db->trans_complete();
                
                if($this->db->trans_status()===FALSE){
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                }   
                
                redirect_with_msg('raw_materials/delivery_challans/index', 'Successfully Canceled');
        }catch(UserException $error){
            $this->db->trans_rollback();            
            redirect_with_msg('raw_materials/delivery_challans/index', 'Something Went Wrong');
        }        
    }
    

    function delete_delivery_challan($id){
        if (!empty($id)){
           try{ 
                $this->db->trans_start();
                
                $do_id = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $id), '*');
                $r=$this->m_common->update_row('rm_delivery_challans', array('dc_id' => $id), array('is_active' =>0));
               
                
                $customer_id =$do_id[0]['customer_id'];
                $challan_code =explode('/', $do_id[0]['dc_no']);
                $challan_code =(int)$challan_code[3];
                $code = $this->m_common->get_row_array('rm_delivery_challan_code', array('challan_code' => $challan_code, 'customer_id' => $customer_id), '*', 'customer_id', '1', 'id', 'desc');
                if (!empty($code))
                    $this->m_common->delete_row('rm_delivery_challan_code', array('id' => $code[0]['id']));
                $delivery_challan_info = $do_id;
                //$delivery_challan_products = $this->m_common->get_row_array('rm_delivery_challan_details', array('dc_id' => $id), '*');
                $dcd_sql="select * from rm_delivery_challan_details dcd left join rm_items tsp on dcd.s_item_id=tsp.id where dcd.dc_id=$id";
                $delivery_challan_products=$this->m_common->customeQuery($dcd_sql);
                

                foreach ($delivery_challan_products as $c_product){
                   
                        $delivery_order_products=array();
                        $delivery_order_product=$this->m_common->get_row_array('rm_delivery_orders_details', array('do_details_id' => $c_product['do_details_id'],'s_item_id'=>$c_product['s_item_id']),'*');
                        $delivery_quanity = $delivery_order_product[0]['delivery_quantity']-$c_product['quantity'];
                        $this->m_common->update_row('rm_delivery_orders_details', array('do_details_id' =>$c_product['do_details_id'],'s_item_id'=>$c_product['s_item_id']),array('delivery_quantity'=>$delivery_quanity));
                    
                }
                $this->m_common->update_row('rm_delivery_challan_details', array('dc_id' => $id), array('is_active' => 0));
                
                $this->db->trans_complete();
                
                if($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                }   
                redirect_with_msg('raw_materials/delivery_challans/index', 'Successfully Deleted');
                
           }catch(UserException $error){
                $this->db->trans_rollback();            
                redirect_with_msg('raw_materials/delivery_challans/index', 'Something Went Wrong');
           }      
        } else {
            redirect_with_msg('raw_materials/delivery_challans/index', 'Please click on delete button');
        }
    }

    
    function hook_challans(){
        $branch_id = $this->session->userdata('companyId');
//        $this->menu = 'sales';
//        $this->sub_menu = 'sale';
//        $this->sub_inner_menu = 'delivery_challan';

        $this->menu = 'trading';
        $this->sub_menu = 'rm_challan';
        $this->sub_inner_menu = 'hook_delivery_challan';

        $this->titlebackend("Delivery Challan");
        
//        $sql="select * from rm_delivery_challan_details where amount<1";
//        $challan_info=$this->m_common->customeQuery($sql);
//        foreach($challan_info as $challan){
//            $price=array();
//            $price=$this->m_common->get_row_array('rm_delivery_orders_details',array('do_details_id'=>$challan['do_details_id']),'*');
//            $unit_price=$price[0]['unit_price'];
//            $amount=round(($price[0]['unit_price']*$challan['quantity']),2);
//            $this->m_common->update_row('rm_delivery_challan_details',array('dc_details_id'=>$challan['dc_details_id']),array('unit_price'=>$unit_price,'amount'=>$amount));
//        }
        
        // $data['sale_challan']=$this->m_common->get_row_array('rm_sales_sale_challan
        // $sql="select dc.*,do.delivery_no,c.c_name,c.c_short_name from rm_delivery_challans dc left join rm_delivery_orders do on dc.do_id=do.do_id left join rm_sales_orders so on do.o_id=so.o_id left join rm_sales_quotation q on so.q_id=q.q_id left join rm_customers c on q.customer_id=c.id where dc.is_active=1 order by dc_id DESC";
      //  $sql = "select dc.*,do.delivery_no,c.c_name,c.c_short_name from rm_delivery_challans dc left join rm_delivery_orders do on dc.do_id=do.do_id left join rm_sales_orders so on do.o_id=so.o_id left join rm_customers c on so.customer_id=c.id where dc.is_active=1 and dc.delivery_challan_date>='2020-10-01' and dc.unit_id=" . $branch_id . " order by dc_id DESC";//27-12-2020
        // $sql = "select dc.*,do.delivery_no,c.c_name,c.c_short_name,tdcd.bill_status from rm_delivery_challans dc 
        // left join rm_delivery_challan_details tdcd on tdcd.dc_id=dc.dc_id 
        // left join rm_delivery_orders do on dc.do_id=do.do_id 
        // left join rm_sales_orders so on do.o_id=so.o_id 
        // left join rm_customers c on so.customer_id=c.id where dc.is_active=1 and dc.delivery_challan_date>='2020-10-01' and dc.unit_id=" . $branch_id . " order by dc_id DESC";
        // $data['delivery_challans'] = $this->m_common->customeQuery($sql);
        $this->load->view('raw_materials/delivery_challans/v_hook_delivery_challan', $data);
    }

    public function hook_delv_challan_list(){
        $branch_id = $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
           // POST data
           $postData = $this->input->post();
           $user_id =$this->session->userdata('user_id');
           $userData =$this->m_common->get_row_array('users',array('id' =>$user_id),'*');
           $this->role =checkUserPermission(18,124, $userData);
           
           $this->load->library('DataTables');
           $this->datatables->setDatabase($this->db->database);
           $aTable = 'rm_delivery_challans';
           $aColumns = array('rm_delivery_challans.dc_id','rm_delivery_challans.delivery_challan_date','rm_delivery_challans.dc_no','rm_delivery_challans.manual_dc_no','rm_delivery_challan_details.quantity','tbl_customers.c_name','rm_delivery_challans.status','rm_delivery_challan_details.bill_status','rm_items.item_name','tbl_measurement_unit.meas_unit');
           $joinTable = array('rm_delivery_challan_details','tbl_customers','rm_items','tbl_measurement_unit');
           $JoinCriteria = array('rm_delivery_challan_details.dc_id=rm_delivery_challans.dc_id','rm_delivery_challans.customer_id=tbl_customers.id','rm_delivery_challan_details.s_item_id=rm_items.id','tbl_measurement_unit.id=rm_items.mu_id');
           $joinStatus = array('','left','left','left','left','left');
         //  $where = 'rm_delivery_challans.unit_id='.$branch_id;
          // $where['rm_delivery_challans.unit_id']=$branch_id;
           $where['rm_delivery_challans.delivery_location']='Hook';
           $where['rm_delivery_challans.is_active']=1;
           $records = $this->datatables->get_json($aTable, $aColumns,$joinTable,$JoinCriteria,$joinStatus,$where);
          //echo $this->db->last_query();exit;
           $data = array();
           foreach($records['data'] as $key=>$record ){
      
               $data[$key] = array( 
                  "dc_id"=>$record->dc_id,
                  "delivery_challan_date"=>$record->delivery_challan_date,
                  "dc_no"=>$record->dc_no,
                  "manual_dc_no"=>$record->manual_dc_no,
                  "quantity"=>$record->quantity,
                  "c_name"=>$record->c_name,
                   "item_name"=>$record->item_name,
                   "meas_unit"=>$record->meas_unit,
                  
                  "project_name"=>'',
                  "status"=>$record->status,
                ); 
               
               
                $action='';
                if($record->status=="Pending"){
                    if (in_array(4,$this->role)) {
                        $action.='<a href="'.site_url('raw_materials/delivery_challans/details_hook_delivery_challan/'.$record->dc_id).'"><button class="btn btn-sm btn-success" >View</button></button></a>';
                    }
                    if (in_array(3,$this->role) || (in_array($userData[0]['user_type'],array(1,3)))){
                        $action.='<a href="'.site_url('raw_materials/delivery_challans/edit_hook_delivery_challan/'.$record->dc_id).'"><button class="btn btn-sm btn-success" >Edit</a>';
                    }
                    
                    if(in_array(2,$this->role)){
                        $action.='<a href="'.site_url('raw_materials/delivery_challans/approve_hook_delivery_challan/'.$record->dc_id).'"><button class="btn btn-sm btn-success">Approve</i></a>';
                    }
                    
                    if(in_array(5,$this->role)){
                        $action.='<button onclick="delete_row(\''.site_url('raw_materials/delivery_challans/delete_hook_delivery_challan/'.$record->dc_id).'\')" class="btn btn-sm btn-danger">Delete</button>';
                    }
                
                
                
                
                }else{
                    if (in_array(4, $this->role)) {
                        $action.='<a href="'.site_url('raw_materials/delivery_challans/details_hook_delivery_challan/'.$record->dc_id).'"><button class="btn btn-sm btn-success" >View</button></button></a>';
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
    
    function add_hook_delivery_challan() {
        $branch_id = $this->session->userdata('companyId');
//        $this->menu = 'sales';
//        $this->sub_menu = 'sale';
//        $this->sub_inner_menu = 'delivery_challan';

        $this->menu = 'trading';
        $this->sub_menu = 'rm_challan';
        $this->sub_inner_menu = 'hook_delivery_challan';


        $this->titlebackend("Quotation Information");
        $c_sql="select c.* from tbl_customers c where c.customer_category='Raw Material' ";
        $data['customers']=$this->m_common->customeQuery($c_sql);
        
        $data['drivers'] = $this->m_common->get_row_array('tbl_driver', array('is_active' => 1,'transport_type'=>"Ship"), '*');
        $data['helpers'] = $this->m_common->get_row_array('tbl_helper', array('is_active' => 1), '*');
        $data['trucks'] = $this->m_common->get_row_array('tbl_truck', array('is_active' => 1,'transport_type'=>"Ship"), '*');
        $data['transport_companies']=$this->m_common->get_row_array('rm_transport_company',array('is_active'=>1,'transport_type'=>"Ship"),'*');
        $this->load->view('raw_materials/delivery_challans/v_add_hook_delivery_challan', $data);
    }

    

    function add_hook_delivery_challan_action(){
        $user_id=$this->session->userdata('user_id');
        $branch_id = $this->session->userdata('companyId');
        $postData = $this->input->post();
        if(!empty($postData)){
            try{
                    
                    $insertData = array();
                    $customer_id = $postData['customer_id'];
                    if(empty($postData['select_product'])){
                        redirect_with_msg('raw_materials/delivery_challans/add_delivery_challan', 'Please Select Product');
                    }

                    
                    if (!empty($postData['customer_id'])){
                        $insertData['customer_id'] = $postData['customer_id'];
                    }
                    
                   
                    if(!empty($postData['challan_time'])){
                        $insertData['challan_time'] = $postData['challan_time'];
                    }


                    

        
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

                    
                    
                    if (!empty($postData['shipping_address'])) {
                        $insertData['shipping_address'] = $postData['shipping_address'];
                    }
                    if (!empty($postData['shipping_email'])) {
                        $insertData['shipping_email'] = $postData['shipping_email'];
                    }

                    if (!empty($postData['total_amount'])) {
                        $insertData['total_amount'] = $postData['total_amount'];
                    }

                    if(!empty($postData['driver_id'])){
                        $insertData['driver_id'] = $postData['driver_id'];
                        $driver_info=$this->m_common->get_row_array('tbl_driver',array('driver_id'=>$postData['driver_id']),'*');
                        $driver_name=$driver_info[0]['driver_name'];
                    }
                    
                    if (!empty($postData['driver_name'])){
                        $driver_name=$postData['driver_name'];
                    }
                                        
                    if (!empty($postData['helper_id'])) {
                        $insertData['helper_id'] = $postData['helper_id'];
                        $helper_info=$this->m_common->get_row_array('tbl_helper',array('helper_id'=>$postData['helper_id']),'*');
                        $helper_name=$helper_info[0]['helper_name'];
                    }
                    
                    if (!empty($postData['helper_name'])){
                        $helper_name=$postData['helper_name'];
                    }
                    
                    
                    if (!empty($postData['truck_id'])) {
                        $insertData['truck_id'] = $postData['truck_id'];
                        $truck_info=$this->m_common->get_row_array('tbl_truck',array('truck_id'=>$postData['truck_id']),'*');
                        $truck_no=$truck_info[0]['truck_no'];
                    }
                    
                    
                    if (!empty($postData['truck_no'])){
                        $truck_no=$postData['truck_no'];
                    }
                    
                    
                    

                    if (!empty($postData['transport_type'])) {
                        $insertData['transport_type'] = $postData['transport_type'];
                    }
                    
                    if (!empty($postData['t_company_id'])) {
                        $insertData['t_company_id'] = $postData['t_company_id'];
                    }
                    
                    if(!empty($postData['manual_dc_no'])){
                        $insertData['manual_dc_no'] = $postData['manual_dc_no'];
                    }
                    
                    $insertData['driver_name'] =$driver_name;
                    $insertData['helper_name'] =$helper_name;
                    $insertData['truck_no'] =$truck_no;
                    
                    $insertData['delivery_location'] ='Hook';
                    
                    $insertData['created_by'] =$user_id;
                    
                    $insertData['unit_id'] =$branch_id;
                    $insertData['is_active'] =1;
                    $insertData['status'] ='Pending';

                    $insertData['challan_date_time'] =date('Y-m-d H:i:s');
                    $insertData['created_date'] = date('Y-m-d');
                    
                    

                    $this->db->trans_start();
                    
                    $result = $this->m_common->insert_row('rm_delivery_challans',$insertData);
                    if (!empty($result)) {
                        //$this->m_common->insert_row('rm_delivery_challan_code', array('challan_code' => $postData['challan_code'], 'customer_id' => $postData['customer_id'], 'unit_id' => $branch_id));
                        // $this->m_common->update_row('rm_delivery_orders', array('do_id' =>$do_id),array('status'=>"Delivered"));
                        foreach ($postData['s_item_id'] as $key => $each) {
                            if (in_array($key+1, $postData['select_product'])) {
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
                                
                                
                                if(!empty($postData['lc_details_id'][$key])){
                                    $insertData1['lc_details_id'] = $postData['lc_details_id'][$key];
                                    
                                }
                                
                                if(!empty($postData['do_details_id'][$key])){
                                    $insertData1['do_details_id'] = $postData['do_details_id'][$key];
                                    
                                }

                                if(!empty($postData['do_qty'][$key])){
                                    $insertData1['do_qty']=$postData['do_qty'][$key];
                                }
                                
                                if (!empty($postData['unit_price'][$key])) {
                                    $insertData1['unit_price'] = $postData['unit_price'][$key];
                                }

                                
                                $insertData1['amount'] =$postData['unit_price'][$key]*$postData['quantity'][$key];

                                $this->m_common->insert_row('rm_delivery_challan_details', $insertData1);
                            }
                        }
                        // qty update for do
                       // $delivery_challan_info = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $result), '*');
                      //  $delivery_challan_products = $this->m_common->get_row_array('rm_delivery_challan_details', array('dc_id' => $result), '*');
                        $dcd_sql="select * from rm_delivery_challan_details dcd left join rm_items tsp on dcd.s_item_id=tsp.id where dcd.dc_id=$result";
                        $delivery_challan_products=$this->m_common->customeQuery($dcd_sql);
                        if(!empty($result)){
                            
                            foreach ($delivery_challan_products as $c_product){
                               
                                    $delivery_order_products = array();
                                    $delivery_order_product = $this->m_common->get_row_array('rm_delivery_orders_details', array('do_details_id' => $c_product['do_details_id'],'s_item_id'=>$c_product['s_item_id']),'*');
                                    $delivery_quanity = $delivery_order_product[0]['delivery_quantity']+$c_product['quantity'];
                                    $this->m_common->update_row('rm_delivery_orders_details', array('do_details_id' => $c_product['do_details_id'], 's_item_id' => $c_product['s_item_id']), array('delivery_quantity' => $delivery_quanity));
                                
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
                    redirect_with_msg('raw_materials/delivery_challans/hook_challans', 'Successfully Inserted');
            }catch(UserException $error){
                $this->db->trans_rollback();               
                redirect_with_msg('raw_materials/delivery_challans/hook_challans', 'Something went wrong');
            }        
            
        } else {
            redirect_with_msg('raw_materials/delivery_challans/add_hook_delivery_challan', 'Please fill the form and submit');
        }
    }

    function edit_hook_delivery_challan($id) {
        $branch_id = $this->session->userdata('companyId');
        
        $this->menu = 'Trading';
        $this->sub_menu = 'rm_challan';
        $this->sub_inner_menu = 'hook_delivery_challan';


        $this->titlebackend("Delivery Challan Information");
        
        $c_sql="select c.* from tbl_customers c where c.customer_category='Raw Material' ";
        $data['customers']=$this->m_common->customeQuery($c_sql);
        
       
        $data['delivery_challan_info'] = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $id), '*');
        // $sql="select d.*,item.s_item_name from rm_delivery_challan_details d left join rm_sales_items item on d.s_item_id=item.s_item_id where d.is_active=1";
        $sql = "select d.*,do.delivery_no,sp.item_name,sp.origin,sp.item_grade,tmu.meas_unit from rm_delivery_challan_details d 
left join rm_delivery_challans as dc on dc.dc_id=d.dc_id
left join rm_delivery_orders_details dod on d.do_details_id=dod.do_details_id
left join rm_delivery_orders do on dod.do_id=do.do_id
left join rm_items sp on d.s_item_id=sp.id
left join tbl_measurement_unit tmu on sp.mu_id=tmu.id 
where d.is_active=1 and d.dc_id=".$id;
        
        $data['delivery_challan_details_info'] = $this->m_common->customeQuery($sql);        
        $data['drivers'] = $this->m_common->get_row_array('tbl_driver', array('is_active' => 1,'transport_type'=>"Ship"), '*');
        $data['helpers'] = $this->m_common->get_row_array('tbl_helper', array('is_active' => 1), '*');
        $data['trucks'] = $this->m_common->get_row_array('tbl_truck', array('is_active' => 1,'transport_type'=>"Ship"), '*');
        $data['transport_companies']=$this->m_common->get_row_array('rm_transport_company',array('is_active'=>1,'transport_type'=>"Ship"),'*');
        $this->load->view('raw_materials/delivery_challans/v_edit_hook_delivery_challan', $data);
    }

    function edit_hook_delivery_challan_action($dc_id) {
        $user_id=$this->session->userdata('user_id');
        $postData=$this->input->post();
        if(!empty($postData)){
            $pre_info = $this->m_common->get_row_array('rm_delivery_challans', array('do_id' => $do_id), '*');
            $insertData = array();

            if(empty($postData['select_product'])){
                redirect_with_msg('raw_materials/delivery_challans/edit_hook_delivery_challan_action/' . $dc_id, 'Please Select Product');
            }

            
            if(!empty($postData['customer_id'])){
                $insertData['customer_id'] = $postData['customer_id'];
            }
            
            if(!empty($postData['delivery_challan_date'])){
                $insertData['delivery_challan_date'] = date('Y-m-d', strtotime($postData['delivery_challan_date']));
            }

            if (!empty($postData['challan_time'])) {
                $insertData['challan_time'] = $postData['challan_time'];
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

           
            if (!empty($postData['shipping_address'])) {
                $insertData['shipping_address'] = $postData['shipping_address'];
            }
            if (!empty($postData['shipping_email'])) {
                $insertData['shipping_email'] = $postData['shipping_email'];
            }

            if (!empty($postData['total_amount'])) {
                $insertData['total_amount'] = $postData['total_amount'];
            }

            
            if(!empty($postData['driver_id'])){
                $insertData['driver_id'] = $postData['driver_id'];
                $driver_info=$this->m_common->get_row_array('tbl_driver',array('driver_id'=>$postData['driver_id']),'*');
                $driver_name=$driver_info[0]['driver_name'];
            }

            if (!empty($postData['driver_name'])){
                $driver_name=$postData['driver_name'];
            }

            if (!empty($postData['helper_id'])) {
                $insertData['helper_id'] = $postData['helper_id'];
                $helper_info=$this->m_common->get_row_array('tbl_helper',array('helper_id'=>$postData['helper_id']),'*');
                $helper_name=$helper_info[0]['helper_name'];
            }

            if (!empty($postData['helper_name'])){
                $helper_name=$postData['helper_name'];
            }


            if (!empty($postData['truck_id'])) {
                $insertData['truck_id'] = $postData['truck_id'];
                $truck_info=$this->m_common->get_row_array('tbl_truck',array('truck_id'=>$postData['truck_id']),'*');
                $truck_no=$truck_info[0]['truck_no'];
            }


            if (!empty($postData['truck_no'])){
                $truck_no=$postData['truck_no'];
            }




            if (!empty($postData['transport_type'])) {
                $insertData['transport_type'] = $postData['transport_type'];
            }

            if(!empty($postData['t_company_id'])){
                $insertData['t_company_id'] = $postData['t_company_id'];
            }

            if(!empty($postData['manual_dc_no'])){
                $insertData['manual_dc_no'] = $postData['manual_dc_no'];
            }
            
            $insertData['driver_name'] =$driver_name;
            $insertData['helper_name'] =$helper_name;
            $insertData['truck_no'] =$truck_no;
            $insertData['updated_by'] =$user_id;

            $this->db->trans_start();
            
            $result = $this->m_common->update_row('rm_delivery_challans', array('dc_id' => $dc_id), $insertData);
            if($result>=0){
                
                //$exists = $this->m_common->get_row_array('rm_delivery_challan_details', array('dc_id' => $dc_id), '*');
                //$this->m_common->delete_row('rm_delivery_challan_details',array('dc_id'=>$dc_id));
                foreach ($postData['s_item_id'] as $key => $each) {
                    if (in_array($key+1, $postData['select_product'])) {
                        $exists=array();
                        $exists = $this->m_common->get_row_array('rm_delivery_challan_details', array('do_details_id' =>$postData['do_details_id'][$key]), '*');
                        
                        $insertData1 = array();
                        $insertData1['dc_id'] = $dc_id;
                        $insertData1['s_item_id'] = $each;
                        $insertData1['is_active'] = 1;
                       // $insertData1['bill_status'] = 'Pending';
                       // $insertData1['receive_status'] = 'Pending';
                        if (empty($each)) {
                            continue;
                        }
                        if(!empty($postData['quantity'][$key])){
                            $insertData1['quantity'] = $postData['quantity'][$key];
                            $insertData1['challan_qty'] = $postData['quantity'][$key];
                        }

                        
                        if(!empty($postData['lc_details_id'][$key])){
                            $insertData1['lc_details_id'] = $postData['lc_details_id'][$key];

                        }
                        
                        
                        if(!empty($postData['do_details_id'][$key])){
                            $insertData1['do_details_id']=$postData['do_details_id'][$key];

                        }
                        
                        
                        if(!empty($postData['do_qty'][$key])){
                            $insertData1['do_qty']=$postData['do_qty'][$key];
                        }

                        
                        if(!empty($postData['unit_price'][$key])){
                            $insertData1['unit_price'] = $postData['unit_price'][$key];
                        }

                        
                        
                        $insertData1['amount']=$postData['unit_price'][$key]*$postData['quantity'][$key];

                        $this->m_common->update_row('rm_delivery_challan_details',array('dc_details_id'=>$postData['dc_details_id'][$key]),$insertData1);

                        $d=array();
                        $sql = "select d.* 
from rm_delivery_orders_details d  where d.is_active=1 and d.s_item_id=$each and d.do_details_id=" . $postData['do_details_id'][$key];
                        $d=$this->m_common->customeQuery($sql);
                        if(!empty($d)){
                            $qty = $d[0]['delivery_quantity'] - $exists[0]['quantity'];
                            $qty = $qty + $postData['quantity'][$key];
                            $this->m_common->update_row('rm_delivery_orders_details', array('do_details_id'=>$d[0]['do_details_id']),array('delivery_quantity'=> $qty));
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
            
            
            redirect_with_msg('raw_materials/delivery_challans/hook_challans', 'Successfully Updated');
            
        } else {

            redirect_with_msg('raw_materials/delivery_challans/edit_hook_delivery_challan_action/' . $dc_id, 'Please fill the form first');
        }
    }

    function details_hook_delivery_challan($id, $print = false) {
        $branch_id = $this->session->userdata('companyId');
        
        $this->menu = 'Trading';
        $this->sub_menu = 'rm_challan';
        $this->sub_inner_menu = 'hook_delivery_challan';


        $this->titlebackend("Delivery Challan Information");
        
        $c_sql="select c.* from tbl_customers c where c.customer_category='Raw Material' ";
        $data['customers']=$this->m_common->customeQuery($c_sql);
        
       
        
        // $sql="select d.*,item.s_item_name from rm_delivery_challan_details d left join rm_sales_items item on d.s_item_id=item.s_item_id where d.is_active=1";
        $sql = "select d.*,do.delivery_no,sp.item_name,sp.origin,sp.item_grade,tmu.meas_unit from rm_delivery_challan_details d 
left join rm_delivery_challans as dc on dc.dc_id=d.dc_id
left join rm_delivery_orders_details dod on d.do_details_id=dod.do_details_id
left join rm_delivery_orders do on dod.do_id=do.do_id
left join rm_items sp on d.s_item_id=sp.id
left join tbl_measurement_unit tmu on sp.mu_id=tmu.id 
where d.is_active=1 and d.dc_id=".$id;
        
        $data['delivery_challan_details_info'] = $this->m_common->customeQuery($sql);        
        $data['drivers'] = $this->m_common->get_row_array('tbl_driver', array('is_active' => 1,'transport_type'=>"Ship"), '*');
        $data['helpers'] = $this->m_common->get_row_array('tbl_helper', array('is_active' => 1), '*');
        $data['trucks'] = $this->m_common->get_row_array('tbl_truck', array('is_active' => 1,'transport_type'=>"Ship"), '*');
        $data['transport_companies']=$this->m_common->get_row_array('rm_transport_company',array('is_active'=>1,'transport_type'=>"Ship"),'*');
        
        
        if ($print == false) {
            $data['delivery_challan_info'] = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $id), '*');
            $this->load->view('raw_materials/delivery_challans/v_hook_details_delivery_challan', $data);
        } else {
            
            $dc_sql = "select dc.*,c.id,c.c_short_name,c.c_name,c.c_contact_person,c.c_mobile_no,c.c_contact_address,td.contact_no as d_contact_no,th.contact_no as h_contact_no from rm_delivery_challans dc left join tbl_customers c on dc.customer_id=c.id left join tbl_driver td on dc.driver_id=td.driver_id left join tbl_helper th on dc.helper_id=th.helper_id left join tbl_truck tt on dc.truck_id=tt.truck_id where dc.dc_id=" . $id;
            $delivery_challan_info= $this->m_common->customeQuery($dc_sql);
            
            
            if(empty($delivery_challan_info[0]['dc_no'])){
                $branch_info=$this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
                $branch = $branch_info[0]['short_name'];
            //    $order_code = $this->m_common->get_row_array('rm_delivery_challan_code', array('customer_id' => $data['delivery_challan_info'][0]['id'], 'unit_id' => $branch_id), '*', '', 1, 'id', 'DESC');
                $order_code = $this->m_common->get_row_array('rm_delivery_challans', array('customer_id' =>$delivery_challan_info[0]['customer_id'],'delivery_location'=>"Hook"),'*');    
                if (!empty($order_code)){
                    $item_id=count($order_code);
                } else {
                    $item_id = "";
                }
                if ($item_id != '') {
                    if ($item_id > 999) {
                        //item_sl_no = item_id;
                        $item_sl_no ='CH/HOOK/'.$delivery_challan_info[0]['c_short_name']. '/'.date('y').'/'.$item_id;
                    }else if ($item_id > 99) {
                        $item_sl_no ='CH/HOOK/'.$delivery_challan_info[0]['c_short_name']. '/'.date('y/')."0".$item_id;
                    }else if ($item_id > 9){
                        $item_sl_no ='CH/HOOK/'.$delivery_challan_info[0]['c_short_name']. '/'.date('y/')."00".$item_id;
                    }else{
                        $item_sl_no = 'CH/HOOK/'.$delivery_challan_info[0]['c_short_name']. '/'.date('y/')."000".$item_id;
                    }
                }else{
                    $item_id = 1;
                    $item_sl_no = 'CH/HOOK/'.$delivery_challan_info[0]['c_short_name']. '/'.date('y/')."0001";
                }



              $print_date_time=date('Y-m-d H:i:s');  
              if(empty($delivery_challan_info[0]['print_date_time'])){
                    $this->m_common->update_row('rm_delivery_challans',array('dc_id' =>$id),array('dc_no'=>$item_sl_no,'print_date_time'=>$print_date_time)); 
              }else{
                    $this->m_common->update_row('rm_delivery_challans',array('dc_id' =>$id),array('dc_no'=>$item_sl_no));   
              }
                //$this->m_common->update_row('rm_delivery_challans',array('dc_id' =>$id),array('dc_no'=>$item_sl_no)); 
                //$this->m_common->insert_row('rm_delivery_challan_code',array('challan_code'=>$item_id,'customer_id'=>$data['delivery_challan_info'][0]['id'],'unit_id'=>$branch_id)); 
            }
            
            
            $dc1_sql = "select dc.*,c.id,c.c_short_name,c.c_name,c.c_contact_person,c.c_mobile_no,c.c_contact_address,td.contact_no as d_contact_no,th.contact_no as h_contact_no from rm_delivery_challans dc left join tbl_customers c on dc.customer_id=c.id left join tbl_driver td on dc.driver_id=td.driver_id left join tbl_helper th on dc.helper_id=th.helper_id left join tbl_truck tt on dc.truck_id=tt.truck_id where dc.dc_id=" . $id;
            $data['delivery_challan_info'] = $this->m_common->customeQuery($dc1_sql);
            
            $html = $this->load->view('raw_materials/delivery_challans/print_hook_delivery_challan', $data, true);
            echo $html;
            exit;
        }
    }
    function details_hook_delivery_challan__($id, $print = false) {
        $branch_id = $this->session->userdata('companyId');
        
        $this->menu = 'Trading';
        $this->sub_menu = 'rm_challan';
        $this->sub_inner_menu = 'hook_delivery_challan';


        $this->titlebackend("Delivery Challan Information");
        
        $c_sql="select c.* from tbl_customers c where c.customer_category='Raw Material' ";
        $data['customers']=$this->m_common->customeQuery($c_sql);
        
       
        //$data['delivery_challan_info'] = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $id), '*');
        
        $sql = "select d.*,do.delivery_no,sp.item_name,sp.origin,sp.item_grade,tmu.meas_unit from rm_delivery_challan_details d 
left join rm_delivery_challans as dc on dc.dc_id=d.dc_id
left join rm_delivery_orders_details dod on d.do_details_id=dod.do_details_id
left join rm_delivery_orders do on dod.do_id=do.do_id
left join rm_items sp on d.s_item_id=sp.id
left join tbl_measurement_unit tmu on sp.mu_id=tmu.id 
where d.is_active=1 and d.dc_id=".$id;
        
        $data['delivery_challan_details_info'] = $this->m_common->customeQuery($sql);

        

        $data['drivers'] = $this->m_common->get_row_array('tbl_driver', array('is_active' => 1), '*');
        $data['helpers'] = $this->m_common->get_row_array('tbl_helper', array('is_active' => 1), '*');
        $data['trucks'] = $this->m_common->get_row_array('tbl_truck', array('is_active' => 1), '*');
        $sql = "select count(*) as sl from rm_delivery_challans where dc_id <= $id and is_active=1";
        
        $data['sl'] = $this->m_common->customeQuery($sql);
        $data['transport_companies']=$this->m_common->get_row_array('rm_transport_company',array('is_active'=>1),'*');
        
        if ($print == false) {
            $this->load->view('raw_materials/delivery_challans/v_hook_details_delivery_challan', $data);
        } else {
            if(empty($data['delivery_challan_info'][0]['dc_no'])){
                $branch_info=$this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
                $branch = $branch_info[0]['short_name'];
                $order_code = $this->m_common->get_row_array('rm_delivery_challan_code', array('customer_id' => $data['delivery_challan_info'][0]['id'], 'unit_id' => $branch_id), '*', '', 1, 'id', 'DESC');
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
                }else{
                    $item_id = 1;
                    $item_sl_no = $branch.'/CH/'. $data['delivery_challan_info'][0]['c_short_name']. '/'.date('y/')."0001";
                }




                $this->m_common->update_row('rm_delivery_challans',array('dc_id' =>$id),array('dc_no'=>$item_sl_no)); 
                $this->m_common->insert_row('rm_delivery_challan_code',array('challan_code'=>$item_id,'customer_id'=>$data['delivery_challan_info'][0]['id'],'unit_id'=>$branch_id)); 
            }
            
            
            $dc_sql = "select dc.*,c.id,c.c_short_name,c.c_name,c.c_contact_person,c.c_mobile_no,c.c_contact_address,td.contact_no as d_contact_no,th.contact_no as h_contact_no from rm_delivery_challans dc left join tbl_customers c on dc.customer_id=c.id left join tbl_driver td on dc.driver_id=td.driver_id left join tbl_helper th on dc.helper_id=th.helper_id left join tbl_truck tt on dc.truck_id=tt.truck_id where dc.dc_id=" . $id;
            $data['delivery_challan_info'] = $this->m_common->customeQuery($dc_sql);
            $html = $this->load->view('raw_materials/delivery_challans/print_hook_delivery_challan', $data, true);
            echo $html;
            exit;
        }
    }

    function approve_hook_delivery_challan($id) {
        $this->menu = 'Trading';
        $this->sub_menu = 'delivery_challan';
        $this->titlebackend("Delivery Challan Information");
        try{
            $this->db->trans_start();
            $delivery_challan_info = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $id), '*');
           // $delivery_challan_products = $this->m_common->get_row_array('rm_delivery_challan_details', array('dc_id' => $id), '*');
            $dcd_sql="select * from rm_delivery_challan_details dcd left join rm_items tsp on dcd.s_item_id=tsp.id where dcd.dc_id=$id";
            $delivery_challan_products=$this->m_common->customeQuery($dcd_sql);
            $result = $this->m_common->update_row('rm_delivery_challans', array('dc_id' => $id), array('status' => "Approved"));
            if(!empty($result)){
                foreach ($delivery_challan_products as $c_product) {
                    
                        $delivery_order_products=array();
                        $delivery_order_product =$this->m_common->get_row_array('rm_delivery_orders_details', array('do_details_id' =>$c_product['do_details_id'],'s_item_id' =>$c_product['s_item_id']),'*');
                        $delivery_quanity=$delivery_order_product[0]['delivery_quantity']; // + $c_product['quantity'];
                        if($delivery_quanity==$delivery_order_product[0]['quantity']){
                            $status = "Delivered";
                        } else {
                            $status = "Partially Delivered";
                        }
                        $this->m_common->update_row('rm_delivery_orders_details',array('do_details_id'=>$c_product['do_details_id'],'s_item_id'=>$c_product['s_item_id']),array('delivery_status'=>$status));
                        
                        
                        
                        $delivery_order_products = $this->m_common->get_row_array('rm_delivery_orders_details',array('do_id'=>$delivery_order_product[0]['do_id']),'*');
                        $j = 0;
                        foreach ($delivery_order_products as $delivery_product) {
                            if ($delivery_product['delivery_status'] != "Delivered") {
                                $j = 1;
                            }
                        }

                        if($j == 1){
                            $this->m_common->update_row('rm_delivery_orders', array('do_id'=>$delivery_order_product[0]['do_id']),array('status' =>"Partially Delivered"));
                        }else{
                            $this->m_common->update_row('rm_delivery_orders', array('do_id'=>$delivery_order_product[0]['do_id']),array('status' =>"Delivered"));
                        } 


                }
            }
            
            
            $this->db->trans_complete();
                
            if($this->db->trans_status() === FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }   
            redirect_with_msg('raw_materials/delivery_challans/hook_challans', 'Successfully Approved');
        }catch(UserException $error){
            $this->db->trans_rollback();            
            redirect_with_msg('raw_materials/delivery_challans/hook_challans', 'Something Went Wrong');
        }      
    }
    
    function hook_delivery_challan_partial_receive($id){
        $branch_id = $this->session->userdata('companyId');
        
        $this->menu='production';
        $this->sub_menu='production';
        $this->sub_inner_menu='delivery_challan';

        $this->titlebackend("Delivery Challan Information");
        $sql = "select do.*,c.c_name,c.c_short_name from rm_delivery_orders do left join rm_sales_orders so on do.o_id=so.o_id left join rm_sales_quotation q on so.q_id=q.q_id left join  rm_customers c on q.customer_id=c.id where do.is_active=1 and (do.status='Pending' or do.status='Partially Delivered' or do.status='Delivered') and do.unit_id=" . $branch_id;
        $data['delivery_orders'] = $this->m_common->customeQuery($sql);
        
        $data['delivery_challan_info'] = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $id), '*');
        // $sql="select d.*,item.s_item_name from rm_delivery_challan_details d left join rm_sales_items item on d.s_item_id=item.s_item_id where d.is_active=1";
        $sql = "select d.*,dc.do_id,sod.remark,sp.product_name,sp.measurement_unit from rm_delivery_challan_details d 
left join rm_delivery_challans as dc on dc.dc_id=d.dc_id
left JOIN rm_delivery_orders doo on doo.do_id=dc.do_id
LEFT JOIN rm_sales_orders so on so.o_id=doo.o_id
LEFT JOIN rm_sales_order_details sod on so.o_id=sod.o_id
left join rm_sales_products sp on d.s_item_id=sp.product_id where d.is_active=1 and d.dc_id=" . $id . " GROUP BY d.s_item_id";
        $data['delivery_challan_details_info'] = $this->m_common->customeQuery($sql);

        $sql ="select d.*,i.product_name,i.measurement_unit from rm_delivery_order_details d left join rm_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and d.do_id=" . $data['delivery_challan_info'][0]['do_id'];
        $data['order_products'] = $this->m_common->customeQuery($sql);

        $this->load->view('delivery_challans/v_hook_delivery_challan_partial_receive', $data);
    }
    
    
    function hook_delivery_challan_partial_receive_action($dc_id){
        $user_id=$this->session->userdata('user_id');
        $postData=$this->input->post();
        if(!empty($postData)){
            $pre_info=$this->m_common->get_row_array('rm_delivery_challans',array('do_id' =>$do_id),'*');
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
            
            $result = $this->m_common->update_row('rm_delivery_challans', array('dc_id' => $dc_id), $insertData);
            if ($result >= 0){
                
                $exists = $this->m_common->get_row_array('rm_delivery_challan_details',array('dc_id' =>$dc_id),'*');
                $this->m_common->delete_row('rm_delivery_challan_details', array('dc_id' => $dc_id));
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

                        $this->m_common->insert_row('rm_delivery_challan_details', $insertData1);

                        $sql = "select d.*,i.product_name,i.measurement_unit 
from rm_delivery_order_details d left join rm_sales_products i on d.s_item_id=i.product_id where d.is_active=1 and d.s_item_id=$each and d.do_id=" . $do_id;
                        $d=$this->m_common->customeQuery($sql);
                        if(!empty($d)){
                            $qty=$d[0]['delivery_quantity']-$exists[0]['quantity'];
                            $qty=$qty+$postData['quantity'][$key];
                            $this->m_common->update_row('rm_delivery_order_details',array('do_details_id' =>$d[0]['do_details_id']),array('delivery_quantity' =>$qty));
                        }
                    
                }
                
            }
            
            
            $this->db->trans_complete();                
            if($this->db->trans_status()===FALSE){
                $this->db->trans_rollback();
            }else{
                $this->db->trans_commit();
            }   
            
            
            redirect_with_msg('raw_materials/delivery_challans/hook_challans','Successfully Received');
            
        } else {

            redirect_with_msg('raw_materials/delivery_challans/edit_hook_delivery_challan_action/'.$dc_id, 'Please fill the form first');
        }
    }
    
    
    
    function cancel_hook_delivery_challan(){
        $this->menu ='sales';
        $this->sub_menu ='delivery_challan';
        $this->titlebackend("Delivery Challan Information");
        try{
                $this->db->trans_start();
                
                $id=$this->input->post('challan_id');
                $remark=$this->input->post('remark');
                
                $this->m_common->update_row('rm_delivery_challans', array('dc_id' => $id),array('remark'=>$remark,'status' => "Canceled"));
                $do_id = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $id), '*');
                $delivery_challan_info=$do_id;
                //$delivery_challan_products = $this->m_common->get_row_array('rm_delivery_challan_details', array('dc_id' => $id), '*');
                $dcd_sql="select * from rm_delivery_challan_details dcd left join rm_items tsp on dcd.s_item_id=tsp.id where dcd.dc_id=$id";
                $delivery_challan_products=$this->m_common->customeQuery($dcd_sql);

                foreach ($delivery_challan_products as $c_product) {
                    
                        $delivery_order_products=array();
                        $delivery_order_product=$this->m_common->get_row_array('rm_delivery_orders_details', array('do_details_id' =>$c_product['do_details_id'],'s_item_id' =>$c_product['s_item_id']),'*');
                        $delivery_quanity =$delivery_order_product[0]['delivery_quantity']-$c_product['quantity'];
                        $this->m_common->update_row('rm_delivery_orders_details', array('do_details_id' => $c_product['do_details_id'],'s_item_id'=>$c_product['s_item_id']),array('delivery_quantity'=>$delivery_quanity));
                    
                }




                $delivery_challan_info = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $id), '*');
                $delivery_challan_products = $this->m_common->get_row_array('rm_delivery_challan_details', array('dc_id' => $id), '*');
                $result = $this->m_common->update_row('rm_delivery_challans', array('dc_id' => $id), array('status' => "Canceled"));
                if (!empty($result)) {
                    foreach ($delivery_challan_products as $c_product){
                        $delivery_order_products = array();
                        $delivery_order_product = $this->m_common->get_row_array('rm_delivery_orders_details', array('do_details_id' => $c_product['do_details_id'], 's_item_id' =>$c_product['s_item_id']),'*');
                        $delivery_quanity = $delivery_order_product[0]['delivery_quantity']; // + $c_product['quantity'];
                        if ($delivery_quanity == $delivery_order_product[0]['quantity']) {
                            $status = "Delivered";
                        }else if($delivery_quanity==0){ 
                            $status = "Pending";
                        }else {
                            $status = "Partially Delivered";
                        }
                        $this->m_common->update_row('rm_delivery_orders_details',array('do_details_id'=>$c_product['do_details_id'],'s_item_id' =>$c_product['s_item_id']),array('delivery_status'=>$status));
                        
                        
                        $delivery_order_products = $this->m_common->get_row_array('rm_delivery_orders_details',array('do_id'=>$delivery_order_product[0]['do_id']),'*');
                        $j = 0;
                        foreach ($delivery_order_products as $delivery_product) {
                            if ($delivery_product['delivery_status'] != "Delivered") {
                                $j = 1;
                            }
                        }

                        if($j == 1){
                            $this->m_common->update_row('rm_delivery_orders', array('do_id'=>$delivery_order_product[0]['do_id']),array('status' =>"Partially Delivered"));
                        }else{
                            $this->m_common->update_row('rm_delivery_orders', array('do_id'=>$delivery_order_product[0]['do_id']),array('status' =>"Delivered"));
                        } 
                        
                    }
                }
               
                
                $this->db->trans_complete();
                
                if($this->db->trans_status()===FALSE){
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                }   
                
                redirect_with_msg('raw_materials/delivery_challans/hook_challans', 'Successfully Canceled');
        }catch(UserException $error){
            $this->db->trans_rollback();            
            redirect_with_msg('raw_materials/delivery_challans/hook_challans', 'Something Went Wrong');
        }        
    }
    

    function delete_hook_delivery_challan($id){
        if (!empty($id)){
           try{ 
                $this->db->trans_start();
                
                $do_id = $this->m_common->get_row_array('rm_delivery_challans', array('dc_id' => $id), '*');
                $r=$this->m_common->update_row('rm_delivery_challans', array('dc_id' => $id), array('is_active' =>0));
               
                
                $customer_id =$do_id[0]['customer_id'];
                $challan_code =explode('/', $do_id[0]['dc_no']);
                $challan_code =(int)$challan_code[3];
                $code = $this->m_common->get_row_array('rm_delivery_challan_code', array('challan_code' => $challan_code, 'customer_id' => $customer_id), '*', 'customer_id', '1', 'id', 'desc');
                if (!empty($code))
                    $this->m_common->delete_row('rm_delivery_challan_code', array('id' => $code[0]['id']));
                $delivery_challan_info = $do_id;
                //$delivery_challan_products = $this->m_common->get_row_array('rm_delivery_challan_details', array('dc_id' => $id), '*');
                $dcd_sql="select * from rm_delivery_challan_details dcd left join rm_items tsp on dcd.s_item_id=tsp.id where dcd.dc_id=$id";
                $delivery_challan_products=$this->m_common->customeQuery($dcd_sql);
                

                foreach ($delivery_challan_products as $c_product){
                   
                        $delivery_order_products=array();
                        $delivery_order_product=$this->m_common->get_row_array('rm_delivery_orders_details', array('do_details_id' => $c_product['do_details_id'],'s_item_id'=>$c_product['s_item_id']),'*');
                        $delivery_quanity = $delivery_order_product[0]['delivery_quantity']-$c_product['quantity'];
                        $this->m_common->update_row('rm_delivery_orders_details', array('do_details_id' =>$c_product['do_details_id'],'s_item_id'=>$c_product['s_item_id']),array('delivery_quantity'=>$delivery_quanity));
                    
                }
                $this->m_common->update_row('rm_delivery_challan_details', array('dc_id' => $id), array('is_active' => 0));
                
                $this->db->trans_complete();
                
                if($this->db->trans_status() === FALSE){
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_commit();
                }   
                redirect_with_msg('raw_materials/delivery_challans/hook_challans', 'Successfully Deleted');
                
           }catch(UserException $error){
                $this->db->trans_rollback();            
                redirect_with_msg('raw_materials/delivery_challans/hook_challans', 'Something Went Wrong');
           }      
        } else {
            redirect_with_msg('raw_materials/delivery_challans/hook_challans', 'Please click on delete button');
        }
    }
    
    
    function getDoInfo(){
        $this->setOutputMode(NORMAL);
        $do_id=$this->input->post('do_id');        
        $data['do_info']=$this->m_common->get_row_array('rm_delivery_orders',array('do_id'=>$do_id),'*');
        echo json_encode($data);
    }
    
    function getDoDetails(){
        $this->setOutputMode(NORMAL);
        $customer_id=$this->input->post('customer_id');
        $sql="select iscd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.item_grade,tmu.meas_unit,rmdo.delivery_no,(select rmlcr.mother_vessel_name from rm_lc_receive as rmlcr where rmlcr.lc_id=rmdo.lc_id) as mother_vessel_name from rm_delivery_orders_details iscd
        left join rm_delivery_orders rmdo on iscd.do_id=rmdo.do_id     
        left join rm_items rmi on iscd.s_item_id=rmi.id 
        left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id        
        where (iscd.delivery_status='Pending' or iscd.delivery_status='Partially Delivered') and iscd.is_active=1 and  rmdo.do_location='Yard' and rmdo.do_status='Approved' and rmdo.closing_status='Open' and rmdo.customer_id=".$customer_id;
        $data['do_details']=$this->m_common->customeQuery($sql);
        $data['customer_info']=$this->m_common->get_row_array('tbl_customers',array('id'=>$customer_id),'*');
        
        foreach($data['do_details'] as $key=>$value){
            $total_challan_qty=array();
            //$tc_sql="select sum(challan_qty) as total_challan_qty from rm_delivery_challan_details where do_details_id=".$value['do_details_id'];
            $tc_sql="select sum(challan_qty) as total_challan_qty from rm_delivery_challan_details rdcd left join rm_delivery_challans rdc on rdcd.dc_id=rdc.dc_id  where rdc.is_active=1 and rdc.status!='Canceled' and rdcd.do_details_id=".$value['do_details_id'];
            $total_challan_qty=$this->m_common->customeQuery($tc_sql);
            if(isset($total_challan_qty[0]['total_challan_qty'])){
                $data['do_details'][$key]['total_challan_qty']=$total_challan_qty[0]['total_challan_qty'];
            }else{
                $data['do_details'][$key]['total_challan_qty']=0;
            }
        }
        
        echo json_encode($data);
        
    } 
    
    
    function getDoDetails_17_01_2022(){
        $this->setOutputMode(NORMAL);
        $customer_id=$this->input->post('customer_id');
        $sql="select iscd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.item_grade,tmu.meas_unit,rmdo.delivery_no from rm_delivery_orders_details iscd
        left join rm_delivery_orders rmdo on iscd.do_id=rmdo.do_id     
        left join rm_items rmi on iscd.s_item_id=rmi.id 
        left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id        
        where (iscd.delivery_status='Pending' or iscd.delivery_status='Partially Delivered') and iscd.is_active=1 and  rmdo.do_location='Yard' and rmdo.do_status='Approved' and rmdo.customer_id=".$customer_id;
        $data['do_details']=$this->m_common->customeQuery($sql);
        $data['customer_info']=$this->m_common->get_row_array('tbl_customers',array('id'=>$customer_id),'*');
        echo json_encode($data);
        
    } 
    
    function getHookDoDetails(){
        $this->setOutputMode(NORMAL);
        $customer_id=$this->input->post('customer_id');
        $sql="select iscd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.item_grade,tmu.meas_unit,rmdo.delivery_no,(select rmlcr.mother_vessel_name from rm_lc_receive as rmlcr where rmlcr.lc_id=rmdo.lc_id) as mother_vessel_name from rm_delivery_orders_details iscd
        left join rm_delivery_orders rmdo on iscd.do_id=rmdo.do_id     
        left join rm_items rmi on iscd.s_item_id=rmi.id 
        left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id         
        where (iscd.delivery_status='Pending' or iscd.delivery_status='Partially Delivered') and iscd.is_active=1 and rmdo.do_location='Hook' and rmdo.closing_status='Open' and rmdo.customer_id=".$customer_id;
        $data['do_details']=$this->m_common->customeQuery($sql);
        $data['customer_info']=$this->m_common->get_row_array('tbl_customers',array('id'=>$customer_id),'*');
        
        foreach($data['do_details'] as $key=>$value){
            $total_challan_qty=array();
            $tc_sql="select sum(challan_qty) as total_challan_qty from rm_delivery_challan_details where do_details_id=".$value['do_details_id'];
            $total_challan_qty=$this->m_common->customeQuery($tc_sql);
            if(isset($total_challan_qty[0]['total_challan_qty'])){
                $data['do_details'][$key]['total_challan_qty']=$total_challan_qty[0]['total_challan_qty'];
            }else{
                $data['do_details'][$key]['total_challan_qty']=0;
            }
        }
        
        echo json_encode($data);
        
    } 
    
    
    function deliveryOrder($location=false){
       $this->menu = 'trading';
       $this->sub_menu = 'rm_challan';
       if($location=="Yard"){
            $this->sub_inner_menu = 'delivery_orders';
       }else{
           $this->sub_inner_menu = 'hook_delivery_orders';
       }
       $this->titlebackend("Delivery Orders");
       $customer_id=$this->input->post('customer_id');
       
        if(!empty($customer_id)){
            if($customer_id=="all"){
                $cust_id='';
            }else{
                $cust_id=$customer_id;
            }
        }
       
                   
        if(!empty($cust_id)){
            $sql="select rdod.*,c.c_name,rdo.do_status,rdo.closing_status,rdo.delivery_no,rdo.delivery_order_date,ri.item_name,tmu.meas_unit from rm_delivery_orders_details rdod left join rm_delivery_orders rdo on rdod.do_id=rdo.do_id left join tbl_customers c on rdo.customer_id=c.id left join rm_items ri on rdod.s_item_id=ri.id left join tbl_measurement_unit tmu on ri.mu_id=tmu.id where rdo.do_location='$location' and rdo.do_status='Approved' and rdo.closing_status='Open' and rdod.is_active=1 and rdo.customer_id=".$cust_id;
            
        }else{
            $sql="select rdod.*,c.c_name,rdo.do_status,rdo.closing_status,rdo.delivery_no,rdo.delivery_order_date,ri.item_name,tmu.meas_unit from rm_delivery_orders_details rdod left join rm_delivery_orders rdo on rdod.do_id=rdo.do_id left join tbl_customers c on rdo.customer_id=c.id left join rm_items ri on rdod.s_item_id=ri.id left join tbl_measurement_unit tmu on ri.mu_id=tmu.id where rdo.do_location='$location' and rdo.do_status='Approved' and rdo.closing_status='Open' and rdod.is_active=1";
        }
        
        //$sql="select rdod.*,c.c_name,rdo.do_status,rdo.closing_status,rdo.delivery_no,rdo.delivery_order_date,ri.item_name,tmu.meas_unit from rm_delivery_orders_details rdod left join rm_delivery_orders rdo on rdod.do_id=rdo.do_id left join tbl_customers c on rdo.customer_id=c.id left join rm_items ri on rdod.s_item_id=ri.id left join tbl_measurement_unit tmu on ri.mu_id=tmu.id where rdod.is_active=1";
        $data['customer_id']=$cust_id;
        $data['delivery_orders']=$this->m_common->customeQuery($sql);
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1,'customer_category'=>'Raw Material'),'*','','','c_name'); 
        if($location=='Yard'){
           $this->load->view('raw_materials/delivery_challans/v_yard_delivery_order',$data);  
        }else{
           $this->load->view('raw_materials/delivery_challans/v_hook_delivery_order',$data);   
        }
        
    }
   

    function details_yard_delivery_order($id) {
       $this->menu = 'trading';
       $this->sub_menu = 'rm_challan';
      
        $this->sub_inner_menu = 'delivery_orders';
      
        $this->titlebackend("Delivery Order Information");
        
        $sql = "select sl.*,c.SUP_NAME as buyer_name,b.b_name as buyer_bank,b1.b_name as our_bank from import_lc sl  left join supplier as c on c.ID=sl.sup_id join tbl_banks b on b.id=sl.party_bank join tbl_banks b1 on b1.id=sl.our_bank order by lc_id DESC";
        $data['lcs'] = $this->m_common->customeQuery($sql);
        
        $c_sql="select c.* from tbl_customers c where c.customer_category='Raw Material' ";
        $data['customers']=$this->m_common->customeQuery($c_sql);
        
        $data['delivery_order_info']=$this->m_common->get_row_array('rm_delivery_orders',array('do_id'=>$id),'*');
       
        $sql="select d.*,sp.item_name,sp.item_grade,sp.origin,tmu.meas_unit from rm_delivery_orders_details d left join rm_items sp on d.s_item_id=sp.id left join tbl_measurement_unit tmu on sp.mu_id=tmu.id where d.is_active=1 and do_id=".$data['delivery_order_info'][0]['do_id'];
        $data['delivery_order_details_info']=$this->m_common->customeQuery($sql);
         
        $data['purchase_conditions']=$this->m_common->get_row_array('rm_delivery_orders_terms_conditions',array('do_id'=>$id),'*');
        
        
        $this->load->view('raw_materials/delivery_challans/v_details_yard_delivery_order',$data);
    } 
    
    
    function details_hook_delivery_order($id) {
       $this->menu = 'trading';
       $this->sub_menu = 'rm_challan';
      
       $this->sub_inner_menu = 'hook_delivery_orders';
       
        $this->titlebackend("Delivery Order Information");
        
        $sql = "select sl.*,c.SUP_NAME as buyer_name,b.b_name as buyer_bank,b1.b_name as our_bank from import_lc sl  left join supplier as c on c.ID=sl.sup_id join tbl_banks b on b.id=sl.party_bank join tbl_banks b1 on b1.id=sl.our_bank order by lc_id DESC";
        $data['lcs'] = $this->m_common->customeQuery($sql);
        
        $c_sql="select c.* from tbl_customers c where c.customer_category='Raw Material' ";
        $data['customers']=$this->m_common->customeQuery($c_sql);
        
        $data['delivery_order_info']=$this->m_common->get_row_array('rm_delivery_orders',array('do_id'=>$id),'*');
       
        $sql="select d.*,sp.item_name,sp.item_grade,sp.origin,tmu.meas_unit from rm_delivery_orders_details d left join rm_items sp on d.s_item_id=sp.id left join tbl_measurement_unit tmu on sp.mu_id=tmu.id where d.is_active=1 and do_id=".$data['delivery_order_info'][0]['do_id'];
        $data['delivery_order_details_info']=$this->m_common->customeQuery($sql);
         
        $data['purchase_conditions']=$this->m_common->get_row_array('rm_delivery_orders_terms_conditions',array('do_id'=>$id),'*');
        
        
        $this->load->view('raw_materials/delivery_challans/v_details_hook_delivery_order',$data);
    } 

}
