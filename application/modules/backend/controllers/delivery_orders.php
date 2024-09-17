<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Delivery_orders extends Site_Controller {

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
        
//        $this->role = checkUserPermission(7, 29, $userData);
//        if ($this->role == false || $this->role == 6) {
//            redirect_with_msg('dashboard/', 'You dont Have permission to access this page');
//        }
        
        $this->load->model("m_common");
        $this->setTemplateFile('template');
        $this->user_id = $this->session->userdata('user_id');
        $this->rank = $this->session->userdata('rank');
        $this->company_id = $this->session->userdata('companyId');
        if(empty($this->company_id)){
             redirect_with_msg('backend/dashboard', 'Please click on enter here button to see this page');
        }
    }

    function index($cust_id=false) {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        $user_category= $this->session->userdata('user_category');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'delivery_order';
        $this->titlebackend("Delivery Orders");
        $customer_id=$this->input->post('customer_id');

        $show_data_info=$this->m_common->get_row_array('tbl_show_data_setting','','*');
        $currentDate=date('Y-m-d');
        $prev_date = date('Y-m-d', strtotime($currentDate .' -'.$show_data_info['0']['day'].' days'));


        if(!empty($customer_id)){
            if($customer_id=="all"){
                $cust_id='';
            }else{
                $cust_id=$customer_id;
            }
        }
        $where = '';
        $where.= "d.unit_id=$branch_id";
        $where.= " and d.is_active=1";
        
        $postData=$this->input->post();
        if (!empty($postData)) {
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            
            $closing_status = $this->input->post('closing_status');
            
            if (!empty($closing_status)) {
                $data['closing_status'] =$closing_status;
                if($closing_status=="Closed"){
                    if (empty($where)) {
                        $where .= "d.closing_status='$closing_status'";
                    } else {
                        $where .= " and d.closing_status='$closing_status'";
                    }
                }else{
                    if (empty($where)) {
                        $where .= "(d.closing_status='Open' or d.closing_status is null)";
                    } else {
                        $where .= " and (d.closing_status='Open' or d.closing_status is null)";
                    }
                }
               
            } else {
                $data['closing_status'] ='';
            }
            
            if(!empty($customer_id)){
                $data['customer_id'] = $customer_id;
                if(empty($where)){
                    $where .= "so.customer_id=$customer_id";
                }else{
                    $where .= " and so.customer_id=$customer_id";
                }
                
                $data['customer_id']='';
            }
            
            if( $user_category==2){
            
               
                $sql="select d.*,so.order_no,c.c_name,tdod.amount,tdod.mu_name,
                tdod.quantity,tdod.unit_price,tpc.category_name from tbl_delivery_orders d 
                left join tbl_sales_orders so on d.o_id=so.o_id 
                left join tbl_sales_quotation q on so.q_id=q.q_id 
                left join tbl_customers c on so.customer_id=c.id 
                left join tbl_delivery_order_details tdod on d.do_id=tdod.do_id 
                left join tbl_sales_products tsp on tdod.s_item_id=tsp.product_id 
                left join tbl_product_categories tpc on tsp.category_id=tpc.category_id 
                where (d.delivery_order_date>='$prev_date' and d.delivery_order_date<='$currentDate') and  $where ";
                
            }else{
                if (!empty($f_date) & !empty($to_date)) {
                    $f_date = date('Y-m-d', strtotime($f_date));
                    $to_date = date('Y-m-d', strtotime($to_date));
                    $data['f_date'] = $f_date;
                    $data['to_date'] = $to_date;
                    $sql="select d.*,so.order_no,c.c_name,tdod.amount,tdod.mu_name,tdod.quantity,tdod.unit_price,tpc.category_name from tbl_delivery_orders d left join tbl_sales_orders so on d.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_delivery_order_details tdod on d.do_id=tdod.do_id left join tbl_sales_products tsp on tdod.s_item_id=tsp.product_id left join tbl_product_categories tpc on tsp.category_id=tpc.category_id where $where and d.delivery_order_date>='$f_date' and d.delivery_order_date<='$to_date'  group by d.do_id order by d.do_id desc";
                }else{
                    $sql="select d.*,so.order_no,c.c_name,tdod.amount,tdod.mu_name,tdod.quantity,tdod.unit_price,tpc.category_name from tbl_delivery_orders d left join tbl_sales_orders so on d.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_delivery_order_details tdod on d.do_id=tdod.do_id left join tbl_sales_products tsp on tdod.s_item_id=tsp.product_id left join tbl_product_categories tpc on tsp.category_id=tpc.category_id where $where ";
                } 
            }        
            
            
            
        }else{

            if( $user_category==2){
               
                if(!empty($cust_id)){
                    $sql="select d.*,so.order_no,c.c_name,tdod.amount,tdod.mu_name,
                    tdod.quantity,tdod.unit_price,tpc.category_name from tbl_delivery_orders d 
                    left join tbl_sales_orders so on d.o_id=so.o_id 
                    left join tbl_sales_quotation q on so.q_id=q.q_id 
                    left join tbl_customers c on so.customer_id=c.id 
                    left join tbl_delivery_order_details tdod on d.do_id=tdod.do_id 
                    left join tbl_sales_products tsp on tdod.s_item_id=tsp.product_id 
                    left join tbl_product_categories tpc on tsp.category_id=tpc.category_id 
                    where (d.delivery_order_date>='$prev_date' and d.delivery_order_date<='$currentDate') and  d.is_active=1 and d.unit_id=".$branch_id.' and so.customer_id='.$cust_id.' and (closing_status="Open" or closing_status is null)  group by d.do_id order by d.do_id desc';
                }else{
                    $sql="select d.*,so.order_no,c.c_name,tdod.amount,tdod.mu_name,
                    tdod.quantity,tdod.unit_price,tpc.category_name from tbl_delivery_orders d 
                    left join tbl_sales_orders so on d.o_id=so.o_id 
                    left join tbl_sales_quotation q on so.q_id=q.q_id 
                    left join tbl_customers c on so.customer_id=c.id 
                    left join tbl_delivery_order_details tdod on d.do_id=tdod.do_id 
                    left join tbl_sales_products tsp on tdod.s_item_id=tsp.product_id 
                    left join tbl_product_categories tpc on tsp.category_id=tpc.category_id 
                    where (d.delivery_order_date>='$prev_date' and d.delivery_order_date<='$currentDate') and d.is_active=1 and d.unit_id=".$branch_id.' and (closing_status="Open" or closing_status is null)  group by d.do_id order by d.do_id desc';
                }
                
                
            }else{
                if($user_type==4){
                    $sql="select d.*,so.order_no,c.c_name,tdod.mu_name,tdod.amount,tdod.quantity,tdod.unit_price,tpc.category_name from tbl_delivery_orders d left join tbl_sales_orders so on d.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_delivery_order_details tdod on d.do_id=tdod.do_id left join tbl_sales_products tsp on tdod.s_item_id=tsp.product_id left join tbl_product_categories tpc on tsp.category_id=tpc.category_id where d.is_active=1 and d.unit_id=".$branch_id.' and created_by='.$user_id.' and (closing_status="Open" or closing_status is null)  group by d.do_id order by d.do_id desc';
                }else{
                
                        if(!empty($cust_id)){
                            $sql="select d.*,so.order_no,c.c_name,tdod.amount,tdod.mu_name,tdod.quantity,tdod.unit_price,tpc.category_name from tbl_delivery_orders d left join tbl_sales_orders so on d.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_delivery_order_details tdod on d.do_id=tdod.do_id left join tbl_sales_products tsp on tdod.s_item_id=tsp.product_id left join tbl_product_categories tpc on tsp.category_id=tpc.category_id where d.is_active=1 and d.unit_id=".$branch_id.' and so.customer_id='.$cust_id.' and (closing_status="Open" or closing_status is null)  group by d.do_id order by d.do_id desc';
                        }else{
                            $sql="select d.*,so.order_no,c.c_name,tdod.amount,tdod.mu_name,tdod.quantity,tdod.unit_price,tpc.category_name from tbl_delivery_orders d left join tbl_sales_orders so on d.o_id=so.o_id left join tbl_sales_quotation q on so.q_id=q.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_delivery_order_details tdod on d.do_id=tdod.do_id left join tbl_sales_products tsp on tdod.s_item_id=tsp.product_id left join tbl_product_categories tpc on tsp.category_id=tpc.category_id where d.is_active=1 and d.unit_id=".$branch_id.' and (closing_status="Open" or closing_status is null)  group by d.do_id order by d.do_id desc';
                        }
                
                }

            }    
            $data['closing_status']='';
            $data['customer_id']=$cust_id;
        }
        
        
        
        $data['delivery_orders']=$this->m_common->customeQuery($sql);
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name'); 
        $this->load->view('delivery_orders/v_delivery_order',$data);
    }

   
    function project_info() {
        $this->setOutputMode(NORMAL);
        $branch_id= $this->session->userdata('companyId');
        $customer_id = $this->input->post('customer_id');

       // $data['data'] = $this->m_common->get_row_array('tbl_project', array('customer_id' => $customer_id), '*');
        $pr_sql="select tp.* from tbl_sales_orders so left join tbl_project tp on so.project_id=tp.project_id  where so.is_active=1 and (so.delivery_order_status='Pending' or so.delivery_order_status='Partially Generated Delivery Order') and so.customer_id=".$customer_id." and so.unit_id=".$branch_id." group by so.project_id";
        $data['data']=$this->m_common->customeQuery($pr_sql);
        
        $order_sql="select so.* from tbl_sales_orders so  where so.is_active=1 and (so.delivery_order_status='Pending' or so.delivery_order_status='Partially Generated Delivery Order') and so.customer_id=".$customer_id." and so.unit_id=".$branch_id;
        $data['order_info']=$this->m_common->customeQuery($order_sql);
       // $data['order_info'] = $this->m_common->get_row_array('tbl_sales_orders', array('customer_id' => $customer_id), '*');
        echo json_encode($data);
    }
    
    
     function add_delivery_order() {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'delivery_order';
        $this->titlebackend("Quotation Information");
       // $data['items']=$this->m_common->get_row_array('tbl_sales_items','','*');
       // $sql="select so.*,c.c_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.status='Pending' ";
      //  $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.status='Approved' ";
      //  $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.status='Pending' and so.unit_id=".$branch_id;
      //  $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and so.delivery_order_status='Pending' and so.unit_id=".$branch_id;
        $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on so.customer_id=c.id where so.is_active=1 and (so.delivery_order_status='Pending' or so.delivery_order_status='Partially Generated Delivery Order') and so.unit_id=".$branch_id;
        $data['sale_orders']=$this->m_common->customeQuery($sql);
        
       // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');//16-09-2020
        
        
        $c_sql="select c.* from tbl_sales_orders so left join  tbl_customers c on so.customer_id=c.id where so.is_active=1 and (so.delivery_order_status='Pending' or so.delivery_order_status='Partially Generated Delivery Order') and so.unit_id=".$branch_id ." group by so.customer_id";
        $data['customers']=$this->m_common->customeQuery($c_sql);
        
        
        $this->load->view('delivery_orders/v_add_delivery_order',$data);
    }
     function add_delivery_order_action() {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        
        $postData=$this->input->post();
         if(!empty($postData)){
            try{ 
                        $this->db->trans_start();
                        $insertData=array();
                        if(!empty($postData['o_id'])){
                            $insertData['o_id']=$postData['o_id'];
                            $o_id=$postData['o_id'];
                        }
                        if(!empty($postData['delivery_no'])){
                            if($user_type==4){
                               $insertData['delivery_no']="Factory/".$postData['delivery_no'];
                            }else{
                               $insertData['delivery_no']=$postData['delivery_no']; 
                            }
                            $pre_delivery_info=$this->m_common->get_row_array('tbl_delivery_orders',array('delivery_no'=>$postData['delivery_no']),'*');
                            if(!empty($pre_delivery_info)){
                               redirect_with_msg('delivery_orders', 'This Delivery order already exists'); 
                            }
                        }
                        if(!empty($postData['delivery_order_date'])){
                            $insertData['delivery_order_date']=date('Y-m-d',strtotime($postData['delivery_order_date']));
                        }

                        if(!empty($postData['delivery_time'])){
                            $insertData['delivery_time']=$postData['delivery_time'];
                        }

                        if(!empty($postData['attention'])){
                            $insertData['attention']=$postData['attention'];
                        }

                        if(!empty($postData['phone'])){
                            $insertData['phone']=$postData['phone'];
                        }

                        if(!empty($postData['contact_person'])){
                            $insertData['contact_person']=$postData['contact_person'];
                        }
                        if(!empty($postData['contact_no'])){
                            $insertData['contact_no']=$postData['contact_no'];
                        }


                        if(!empty($postData['project_name'])){
                            $insertData['project_name']=$postData['project_name'];
                        }

                        if(!empty($postData['project_id'])){
                            $insertData['project_id']=$postData['project_id'];
                        }

                        if(!empty($postData['billing_address'])){
                            $insertData['billing_address']=$postData['billing_address'];
                        }
                        if(!empty($postData['billing_email'])){
                            $insertData['billing_email']=$postData['billing_email'];
                        }
                        if(!empty($postData['shipping_address'])){
                            $insertData['shipping_address']=$postData['shipping_address'];
                        }
                        if(!empty($postData['shipping_email'])){
                            $insertData['shipping_email']=$postData['shipping_email'];
                        }

                        if(!empty($postData['total_amount'])){
                            $insertData['total_amount']=$postData['total_amount'];
                        }

                        if(!empty($postData['special_note'])){
                            $insertData['special_note']=$postData['special_note'];
                        }

                        if(!empty($postData['do_remark'])){
                            $insertData['remark']=$postData['do_remark'];
                        }

                        $insertData['unit_id']=$branch_id;
                        $insertData['is_active']=1;
                        $insertData['status']='Pending';
                        $insertData['do_status']='Pending';
                        $insertData['created_by'] = $user_id;
                        $insertData['created_date'] = date('Y-m-d');
                        if($user_type==4){
                         $insertData['created_from']="Factory";  
                        }else{
                         $insertData['created_from']="Head Office";   
                        }
                        $result=$this->m_common->insert_row('tbl_delivery_orders',$insertData);
                        if(!empty($result)){
                            $r=$this->m_common->insert_row('tbl_delivery_orders_code',array('d_code'=>$postData['d_code'],'customer_id'=>$postData['customer_id'],'unit_id'=>$branch_id));
                          //  $this->m_common->update_row('tbl_sales_orders', array('o_id' =>$o_id),array('status'=>"Generated Delivery Order"));
                        //    $this->m_common->update_row('tbl_sales_orders', array('o_id' =>$o_id),array('delivery_order_status'=>"Generated Delivery Order"));
                             foreach ($postData['s_item_id'] as $key => $each) {
                                 $insertData1=array();
                                 $insertData1['do_id'] = $result;
                                 $insertData1['s_item_id'] = $each;
                                 $insertData1['is_active']=1;
                                 $insertData1['delivery_status']="Pending";
                                 $insertData1['schedule_status']="Pending";
                                 if(empty($each)){
                                     continue;
                                 }

                                 if(!empty($postData['o_details_id'][$key])) {
                                      $insertData1['o_details_id'] = $postData['o_details_id'][$key];
                                 }

                                 if(!empty($postData['so_qty'][$key])) {
                                      $insertData1['so_qty'] = $postData['so_qty'][$key];
                                  }else{
                                      continue;
                                  }

                                 if(!empty($postData['quantity'][$key])) {
                                      $insertData1['quantity'] = $postData['quantity'][$key];
                                  }else{
                                      continue;
                                  }

                                  if(!empty($postData['mu_name'][$key])) { 
                                     $insertData1['mu_name'] = strtoupper($postData['mu_name'][$key]);
                                  } 
                                  
                                  if(isset($postData['base_price'][$key]) && !empty($postData['base_price'][$key])) { 
                                     $insertData1['base_price'] = $postData['base_price'][$key];
                                  }
                                  if(isset($postData['vat'][$key]) && !empty($postData['vat'][$key])) { 
                                     $insertData1['vat'] = $postData['vat'][$key];
                                  }
                                  
                                  if(!empty($postData['unit_price'][$key])) { 
                                     $insertData1['unit_price'] = $postData['unit_price'][$key];
                                  }

                                  if(!empty($postData['amount'][$key])) { 
                                     $insertData1['amount'] = $postData['amount'][$key];
                                  }


                                if(!empty($postData['remark'][$key])) { 
                                    $insertData1['remarks'] = $postData['remark'][$key];
                                 }

                                 $success=$this->m_common->insert_row('tbl_delivery_order_details',$insertData1);
                                 if(!empty($success)){
                                     $so_info=$this->m_common->get_row_array('tbl_sales_order_details',array('o_details_id'=>$postData['o_details_id'][$key]),'*');
                                     $net_do_qty=$so_info[0]['do_qty']+$postData['quantity'][$key];
                                     if($net_do_qty==$so_info[0]['quantity']){
                                         $do_status="Generated Delivery Order";
                                     }else{
                                         $do_status="Partially Generated Delivery Order";
                                     }
                                     $this->m_common->update_row('tbl_sales_order_details',array('o_details_id'=>$postData['o_details_id'][$key]),array('do_qty'=>$net_do_qty,'do_status'=>$do_status));

                                 }
                             }

                             $sql="select * from tbl_sales_order_details where (do_status='Pending' or do_status='Partially Generated Delivery Order') and  o_id=".$o_id;
                             $so_d_info=$this->m_common->customeQuery($sql);
                             $remaining=count($so_d_info);
                             if($remaining>0){
                                  $this->m_common->update_row('tbl_sales_orders', array('o_id' =>$o_id),array('delivery_order_status'=>"Partially Generated Delivery Order"));
                             }else{
                                  $this->m_common->update_row('tbl_sales_orders', array('o_id' =>$o_id),array('delivery_order_status'=>"Generated Delivery Order"));
                             }


                       }

                       $this->db->trans_complete();                
                       if($this->db->trans_status() === FALSE){
                           $this->db->trans_rollback();
                       }else{
                           $this->db->trans_commit();
                       }   

                       redirect_with_msg('delivery_orders', 'Successfully Inserted');
            }catch(UserException $error){
                $this->db->trans_rollback();                
                redirect_with_msg('delivery_orders', 'Something went wrong');
            }        
             
         }else{
              redirect_with_msg('delivery_orders/add_delivery_order', 'Please fill the form and submit');
         }
         
     }
    
     function edit_delivery_order($id) {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'delivery_order';
        $this->titlebackend("Delivery Order Information");
        //$sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and (so.status='Approved' or so.status='Generated Delivery Order')";
       // $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and (so.status='Approved' or so.status='Generated Delivery Order') and so.unit_id=".$branch_id;
        $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and (so.delivery_order_status='Pending' or so.delivery_order_status='Generated Delivery Order' or so.delivery_order_status='Partially Generated Delivery Order') and so.unit_id=".$branch_id;
        $data['sale_orders']=$this->m_common->customeQuery($sql);
        $data['delivery_order_info']=$this->m_common->get_row_array('tbl_delivery_orders',array('do_id'=>$id),'*');
       // $sql="select d.*,item.s_item_name from tbl_delivery_order_details d left join tbl_sales_items item on d.s_item_id=item.s_item_id where d.is_active=1";
        $sql="select d.*,sd.remark,sp.product_name,sp.measurement_unit from tbl_delivery_order_details d left join tbl_sales_order_details sd on sd.o_details_id=d.o_details_id left join tbl_sales_products sp on d.s_item_id=sp.product_id where d.is_active=1 and do_id=".$data['delivery_order_info'][0]['do_id'];
        $data['delivery_order_details_info']=$this->m_common->customeQuery($sql);
        
        $sql="select d.*,sp.product_name,sp.measurement_unit from tbl_sales_order_details d left join tbl_sales_products sp on d.product_id=sp.product_id where d.is_active=1 and d.o_id=".$data['delivery_order_info'][0]['o_id'];
        $data['sales_order_details_info']=$this->m_common->customeQuery($sql);
        
        
        $data['payment_mode']=$this->m_common->get_row_array('tbl_sales_order_payment_condition',array('o_id'=>$data['delivery_order_info'][0]['o_id']),'*');
        
        $all_collection_sql='select * from tbl_payment_collections where payment_status="Received" and o_id='.$data['delivery_order_info'][0]['o_id'];
        $data['all_collections']=$this->m_common->customeQuery($all_collection_sql);
        
        $cash_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Cash" and payment_status="Received" and o_id='.$data['delivery_order_info'][0]['o_id'];
        $data['paid_cash_amount']=$this->m_common->customeQuery($cash_sql);
        $data['total_cash_amount']=$data['payment_mode'][0]['b_cash_amount']+$data['payment_mode'][0]['a_cash_amount'];
        $data['due_cash_amount']=$data['total_cash_amount']-$data['paid_cash_amount'][0]['total'];
        
        $pdc_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Pdc" and payment_status="Received" and o_id='.$data['delivery_order_info'][0]['o_id'];
        $data['paid_pdc_amount']=$this->m_common->customeQuery($pdc_sql);
        $data['total_pdc_amount']=$data['payment_mode'][0]['b_pdc_amount']+$data['payment_mode'][0]['a_pdc_amount'];
        $data['due_pdc_amount']=$data['total_pdc_amount']-$data['paid_pdc_amount'][0]['total'];
        
        
        $lc_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Lc" and payment_status="Received" and o_id='.$data['delivery_order_info'][0]['o_id'];
        $data['paid_lc_amount']=$this->m_common->customeQuery($lc_sql);
        $data['total_lc_amount']=$data['payment_mode'][0]['b_lc_amount']+$data['payment_mode'][0]['a_lc_amount'];
        $data['due_lc_amount']=$data['total_lc_amount']-$data['paid_lc_amount'][0]['total'];
        
        $bg_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Bg" and payment_status="Received" and o_id='.$data['delivery_order_info'][0]['o_id'];
        $data['paid_bg_amount']=$this->m_common->customeQuery($bg_sql);
        $data['total_bg_amount']=$data['payment_mode'][0]['b_bg_amount']+$data['payment_mode'][0]['a_bg_amount'];
        $data['due_bg_amount']=$data['total_bg_amount']-$data['paid_bg_amount'][0]['total'];
        
        
        $data['total_amount']=$data['total_cash_amount']+$data['total_pdc_amount']+$data['total_lc_amount']+$data['total_bg_amount'];
        $data['total_paid']=$data['paid_cash_amount'][0]['total']+$data['paid_pdc_amount'][0]['total']+$data['paid_lc_amount'][0]['total']+$data['paid_bg_amount'][0]['total'];
        $data['total_due']=$data['total_amount']-$data['total_paid']; 
        
        $cl_sql='select sum(amount) as total from tbl_payment_collections where payment_status="Collected" and o_id='.$data['delivery_order_info'][0]['o_id'];
        $cl_amount=$this->m_common->customeQuery($cl_sql);
//        print_r($cl_amount);
//        exit;
        if(!empty($cl_amount)){
            $data['total_collection_amount']=$cl_amount[0]['total'];
        }else{
            $data['total_collection_amount']='';
        }
        
        
        $this->load->view('delivery_orders/v_edit_delivery_order',$data);
    }
    
     function edit_delivery_order_action($do_id) {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
         $postData=$this->input->post();
         if(!empty($postData)){
           try {
                    $this->db->trans_start();
                    
                    $pre_info=$this->m_common->get_row_array('tbl_delivery_orders',array('do_id'=>$do_id),'*');
                    $insertData=array();
                    if(!empty($postData['o_id'])){
                        $insertData['o_id']=$postData['o_id'];
                        $o_id=$postData['o_id'];
                    }

                    if(!empty($postData['delivery_order_date'])){
                        $insertData['delivery_order_date']=date('Y-m-d',strtotime($postData['delivery_order_date']));
                    }

                    if(!empty($postData['delivery_time'])){
                        $insertData['delivery_time']=$postData['delivery_time'];
                    }

                    if(!empty($postData['attention'])){
                        $insertData['attention']=$postData['attention'];
                    }
                    if(!empty($postData['phone'])){
                        $insertData['phone']=$postData['phone'];
                    }

                    if(!empty($postData['contact_person'])){
                        $insertData['contact_person']=$postData['contact_person'];
                    }
                    if(!empty($postData['contact_no'])){
                        $insertData['contact_no']=$postData['contact_no'];
                    }

                    if(!empty($postData['project_name'])){
                        $insertData['project_name']=$postData['project_name'];
                    }

                    if(!empty($postData['project_id'])){
                        $insertData['project_id']=$postData['project_id'];
                    }

                    if(!empty($postData['billing_address'])){
                        $insertData['billing_address']=$postData['billing_address'];
                    }
                    if(!empty($postData['billing_email'])){
                        $insertData['billing_email']=$postData['billing_email'];
                    }
                    if(!empty($postData['shipping_address'])){
                        $insertData['shipping_address']=$postData['shipping_address'];
                    }
                    if(!empty($postData['shipping_email'])){
                        $insertData['shipping_email']=$postData['shipping_email'];
                    }

                    if(!empty($postData['total_amount'])){
                        $insertData['total_amount']=$postData['total_amount'];
                    }

                     if(!empty($postData['special_note'])){
                        $insertData['special_note']=$postData['special_note'];
                    }

                    if(!empty($postData['do_remark'])){
                        $insertData['remark']=$postData['do_remark'];
                    }

                    $insertData['updated_by'] =$user_id;
                    $insertData['updated_date'] =date('Y-m-d H:i:s');

                    $result=$this->m_common->update_row('tbl_delivery_orders',array('do_id'=>$do_id),$insertData);
                    if($result>=0){
                        if($pre_info[0]['o_id']!=$o_id){
       //                     $this->m_common->update_row('tbl_sales_orders', array('o_id' =>$o_id),array('status'=>"Generated Delivery Order"));
       //                     $this->m_common->update_row('tbl_sales_orders', array('o_id' =>$pre_info[0]['o_id']),array('status'=>"Pending"));
                         //     $this->m_common->update_row('tbl_sales_orders', array('o_id' =>$o_id),array('delivery_order_status'=>"Generated Delivery Order"));
                          //    $this->m_common->update_row('tbl_sales_orders', array('o_id' =>$pre_info[0]['o_id']),array('delivery_order_status'=>"Pending"));
                        }
                        $this->m_common->delete_row('tbl_delivery_order_details',array('do_id'=>$do_id));
                        foreach ($postData['s_item_id'] as $key => $each) {
                             $insertData1=array();
                             $insertData1['do_id'] = $do_id;
                             $insertData1['s_item_id'] = $each;
                             $insertData1['is_active']=1;
                             $insertData1['delivery_status']="Pending";
                             $insertData1['schedule_status']="Pending";
                             if(empty($each)){
                                 continue;
                             }

                             if(!empty($postData['o_details_id'][$key])) {
                                  $insertData1['o_details_id'] = $postData['o_details_id'][$key];
                             }


                             if(!empty($postData['so_qty'][$key])) {
                                  $insertData1['so_qty'] = $postData['so_qty'][$key];
                              }else{
                                  continue;
                              }


                             if(!empty($postData['quantity'][$key])) {
                                  $insertData1['quantity'] = $postData['quantity'][$key];
                             }else{
                                 continue;
                             }

                              if(!empty($postData['mu_name'][$key])) { 
                                 $insertData1['mu_name'] = strtoupper($postData['mu_name'][$key]);
                             } 

                             if(isset($postData['base_price'][$key]) && !empty($postData['base_price'][$key])) { 
                                $insertData1['base_price'] = $postData['base_price'][$key];
                             }
                             if(isset($postData['vat'][$key]) && !empty($postData['vat'][$key])) { 
                                $insertData1['vat'] = $postData['vat'][$key];
                             }
                              if(!empty($postData['unit_price'][$key])) { 
                                 $insertData1['unit_price'] = $postData['unit_price'][$key];
                              }
                              if(!empty($postData['amount'][$key])) { 
                                 $insertData1['amount'] = $postData['amount'][$key];
                              }

                             if(!empty($postData['remark'][$key])) { 
                                $insertData1['remarks'] = $postData['remark'][$key];
                             }

                             $success=$this->m_common->insert_row('tbl_delivery_order_details',$insertData1);
                             if(!empty($success)){
                                 $so_info=$this->m_common->get_row_array('tbl_sales_order_details',array('o_details_id'=>$postData['o_details_id'][$key]),'*');
                                 $net_do_qty=$so_info[0]['do_qty']+$postData['quantity'][$key]-$postData['pre_quantity'][$key];
                                 if($net_do_qty==$so_info[0]['quantity']){
                                     $do_status="Generated Delivery Order";
                                 }else{
                                     $do_status="Partially Generated Delivery Order";
                                 }
                                 $this->m_common->update_row('tbl_sales_order_details',array('o_details_id'=>$postData['o_details_id'][$key]),array('do_qty'=>$net_do_qty,'do_status'=>$do_status));

                             }
                         }

                        $sql="select * from tbl_sales_order_details where (do_status='Pending' or do_status='Partially Generated Delivery Order') and  o_id=".$o_id;
                        $so_d_info=$this->m_common->customeQuery($sql);
                        $remaining=count($so_d_info);
                        if($remaining>0){
                              $this->m_common->update_row('tbl_sales_orders', array('o_id' =>$o_id),array('delivery_order_status'=>"Partially Generated Delivery Order"));
                        }else{
                              $this->m_common->update_row('tbl_sales_orders', array('o_id' =>$o_id),array('delivery_order_status'=>"Generated Delivery Order"));
                        } 


                    }
                    if($this->db->trans_status()=== FALSE){
                        $this->db->trans_rollback();
                    }else{
                        $this->db->trans_complete();
                    }

                    redirect_with_msg('delivery_orders', 'Successfully Updated');
            }catch(UserException $error){
                $this->db->trans_rollback();                
                redirect_with_msg('delivery_orders', 'Something went wrong');
            } 
            
         }else{
              redirect_with_msg('delivery_orders/add_delivery_order', 'Please fill the form and submit');
         }
         
     }
     
     function details_delivery_order($id,$print=false) {
        $branch_id = $this->session->userdata('companyId');
        $user_id=$this->session->userdata('user_id');
        $user_type=$this->session->userdata('user_type');
        
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'delivery_order';
        $this->titlebackend("Delivery Order Information");
        //$sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and (so.status='Approved' or so.status='Generated Delivery Order')";
       // $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and (so.status='Approved' or so.status='Generated Delivery Order') and so.unit_id=".$branch_id;
        $sql="select so.*,c.c_name,c.c_short_name from tbl_sales_orders so left join tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where so.is_active=1 and (so.delivery_order_status='Approved' or so.delivery_order_status='Generated Delivery Order') and so.unit_id=".$branch_id;
        $data['sale_orders']=$this->m_common->customeQuery($sql);
        //$data['delivery_order_info']=$this->m_common->get_row_array('tbl_delivery_orders',array('do_id'=>$id),'*');
      //  $dc_sql="select do.*,c.c_name,c.c_contact_person,c.c_mobile_no,c.c_contact_address,so.order_no,so.sale_order_date from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where do.do_id=".$id;
        $dc_sql="select do.*,c.c_name,c.c_contact_person,c.c_mobile_no,c.c_contact_address,so.order_no,so.sale_order_date,tp.project_name from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_project tp on so.project_id=tp.project_id where do.do_id=".$id;
        $data['delivery_order_info']=$this->m_common->customeQuery($dc_sql);
       // $sql="select d.*,item.s_item_name from tbl_delivery_order_details d left join tbl_sales_items item on d.s_item_id=item.s_item_id where d.is_active=1";
        $sql="select d.*,sd.remark,sp.product_name,sp.performance,sp.measurement_unit from tbl_delivery_order_details d left join tbl_sales_order_details sd on sd.o_details_id=d.o_details_id left join tbl_sales_products sp on d.s_item_id=sp.product_id where d.is_active=1 and do_id=".$id;
        $data['delivery_order_details_info']=$this->m_common->customeQuery($sql);
        
        
        $sql="select d.*,sp.product_name,sp.measurement_unit from tbl_sales_order_details d left join tbl_sales_products sp on d.product_id=sp.product_id where d.is_active=1 and d.o_id=".$data['delivery_order_info'][0]['o_id'];
        $data['sales_order_details_info']=$this->m_common->customeQuery($sql);
        
        
        $data['payment_mode']=$this->m_common->get_row_array('tbl_sales_order_payment_condition',array('o_id'=>$data['delivery_order_info'][0]['o_id']),'*');
        
        $all_collection_sql='select * from tbl_payment_collections where payment_status="Received" and o_id='.$data['delivery_order_info'][0]['o_id'];
        $data['all_collections']=$this->m_common->customeQuery($all_collection_sql);
        
        $cash_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Cash" and payment_status="Received" and o_id='.$data['delivery_order_info'][0]['o_id'];
        $data['paid_cash_amount']=$this->m_common->customeQuery($cash_sql);
        $data['total_cash_amount']=$data['payment_mode'][0]['b_cash_amount']+$data['payment_mode'][0]['a_cash_amount'];
        $data['due_cash_amount']=$data['total_cash_amount']-$data['paid_cash_amount'][0]['total'];
        
        $pdc_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Pdc" and payment_status="Received" and o_id='.$data['delivery_order_info'][0]['o_id'];
        $data['paid_pdc_amount']=$this->m_common->customeQuery($pdc_sql);
        $data['total_pdc_amount']=$data['payment_mode'][0]['b_pdc_amount']+$data['payment_mode'][0]['a_pdc_amount'];
        $data['due_pdc_amount']=$data['total_pdc_amount']-$data['paid_pdc_amount'][0]['total'];
        
        
        $lc_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Lc" and payment_status="Received" and o_id='.$data['delivery_order_info'][0]['o_id'];
        $data['paid_lc_amount']=$this->m_common->customeQuery($lc_sql);
        $data['total_lc_amount']=$data['payment_mode'][0]['b_lc_amount']+$data['payment_mode'][0]['a_lc_amount'];
        $data['due_lc_amount']=$data['total_lc_amount']-$data['paid_lc_amount'][0]['total'];
        
        $bg_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Bg" and payment_status="Received" and o_id='.$data['delivery_order_info'][0]['o_id'];
        $data['paid_bg_amount']=$this->m_common->customeQuery($bg_sql);
        $data['total_bg_amount']=$data['payment_mode'][0]['b_bg_amount']+$data['payment_mode'][0]['a_bg_amount'];
        $data['due_bg_amount']=$data['total_bg_amount']-$data['paid_bg_amount'][0]['total'];
        
        
        $data['total_amount']=$data['total_cash_amount']+$data['total_pdc_amount']+$data['total_lc_amount']+$data['total_bg_amount'];
        $data['total_paid']=$data['paid_cash_amount'][0]['total']+$data['paid_pdc_amount'][0]['total']+$data['paid_lc_amount'][0]['total']+$data['paid_bg_amount'][0]['total'];
        $data['total_due']=$data['total_amount']-$data['total_paid']; 
        
        $cl_sql='select sum(amount) as total from tbl_payment_collections where payment_status="Collected" and o_id='.$data['delivery_order_info'][0]['o_id'];
        $cl_amount=$this->m_common->customeQuery($cl_sql);
        if(!empty($cl_amount)){
            $data['total_collection_amount']=$cl_amount[0]['total'];
        }else{
            $data['total_collection_amount']='';
        }
        
        
        
         if($print==false){
             $this->load->view('delivery_orders/v_details_delivery_order',$data);
        }else{
            $html=$this->load->view('delivery_orders/print_delivery_order',$data,true);
            echo $html;
            exit; 
        }
       
    }
     
     
     
     function delete_delivery_order($id) {
        if(!empty($id)) {
            $o_id=$this->m_common->get_row_array('tbl_delivery_orders',array('do_id' => $id),'*');
            $result=$this->m_common->update_row('tbl_delivery_orders', array('do_id' => $id),array('is_active'=>0));
            if(!empty($result)){
                $this->m_common->update_row('tbl_sales_orders', array('o_id' => $o_id[0]['o_id']),array('status'=>"Pending"));
                $this->m_common->update_row('tbl_delivery_order_details', array('do_id' => $id),array('is_active'=>0));
                redirect_with_msg('delivery_orders/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('delivery_orders/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('delivery_orders/index', 'Please click on delete button');
        }
    }
     
     function get_sales_order_item(){
        $branch_id=$this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
        $o_id=$this->input->post('o_id');
        $data['branch_info']=$this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
       // $data['sales_order_info']=$this->m_common->get_row_array('tbl_sales_orders',array('o_id'=>$o_id),'*');
        $order_sql='select so.*,c.c_short_name,c.id from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id where so.o_id='.$o_id;
        $data['sales_order_info']=$this->m_common->customeQuery($order_sql);
      //  $sql="select d.*,i.s_item_name from tbl_sales_order_details d left join tbl_sales_items i on d.s_item_id=i.s_item_id where d.is_active=1 and d.o_id=".$o_id;
        $sql="select d.*,i.product_name,i.measurement_unit from tbl_sales_order_details d left join tbl_sales_products i on d.product_id=i.product_id where d.is_active=1 and d.o_id=".$o_id;
        $data['item_list']=$this->m_common->customeQuery($sql);
        //$data['order_code']=$this->m_common->get_row_array('tbl_delivery_orders_code',array('customer_id'=>$data['sales_order_info'][0]['id']),'*','',1,'id','DESC');
        $data['order_code']=$this->m_common->get_row_array('tbl_delivery_orders_code',array('customer_id'=>$data['sales_order_info'][0]['id'],'unit_id'=>$branch_id),'*','',1,'id','DESC');
        
        
        
        
       
        $data['payment_mode']=$this->m_common->get_row_array('tbl_sales_order_payment_condition',array('o_id'=>$o_id),'*');
        
        $all_collection_sql='select * from tbl_payment_collections where payment_status="Received" and o_id='.$o_id;
        $data['all_collections']=$this->m_common->customeQuery($all_collection_sql);
              
        $cash_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Cash" and payment_status="Received" and o_id='.$o_id;
        $data['paid_cash_amount']=$this->m_common->customeQuery($cash_sql);
        $data['total_cash_amount']=$data['payment_mode'][0]['b_cash_amount']+$data['payment_mode'][0]['a_cash_amount'];
        $data['due_cash_amount']=$data['total_cash_amount']-$data['paid_cash_amount'][0]['total'];
        
        $pdc_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Pdc" and payment_status="Received" and o_id='.$o_id;
        $data['paid_pdc_amount']=$this->m_common->customeQuery($pdc_sql);
        $data['total_pdc_amount']=$data['payment_mode'][0]['b_pdc_amount']+$data['payment_mode'][0]['a_pdc_amount'];
        $data['due_pdc_amount']=$data['total_pdc_amount']-$data['paid_pdc_amount'][0]['total'];
        
        
        $lc_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Lc" and payment_status="Received" and o_id='.$o_id;
        $data['paid_lc_amount']=$this->m_common->customeQuery($lc_sql);
        $data['total_lc_amount']=$data['payment_mode'][0]['b_lc_amount']+$data['payment_mode'][0]['a_lc_amount'];
        $data['due_lc_amount']=$data['total_lc_amount']-$data['paid_lc_amount'][0]['total'];
        
        $bg_sql='select sum(amount) as total from tbl_payment_collections where collection_method="Bg" and payment_status="Received" and o_id='.$o_id;
        $data['paid_bg_amount']=$this->m_common->customeQuery($bg_sql);
        $data['total_bg_amount']=$data['payment_mode'][0]['b_bg_amount']+$data['payment_mode'][0]['a_bg_amount'];
        $data['due_bg_amount']=$data['total_bg_amount']-$data['paid_bg_amount'][0]['total'];
        
        
        $data['total_amount']=$data['total_cash_amount']+$data['total_pdc_amount']+$data['total_lc_amount']+$data['total_bg_amount'];
        $data['total_paid']=$data['paid_cash_amount'][0]['total']+$data['paid_pdc_amount'][0]['total']+$data['paid_lc_amount'][0]['total']+$data['paid_bg_amount'][0]['total'];
        $data['total_due']=$data['total_amount']-$data['total_paid'];
        
        
        $cl_sql='select sum(amount) as total from tbl_payment_collections where payment_status="Collected" and o_id='.$o_id;
        $cl_amount=$this->m_common->customeQuery($cl_sql);
        if(!empty($cl_amount)){
            $data['total_collection_amount']=$cl_amount[0]['total'];
        }else{
            $data['total_collection_amount']='';
        }
        
        
        
        $sql="select si.* from tbl_sales_invoices si left join tbl_delivery_orders do on si.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id where si.is_active=1 and do.o_id=$o_id";
        $data['invoices']=$this->m_common->customeQuery($sql);   
        
        echo json_encode($data);
     }
    
   
    function approve_delivery_order($id){
         $result=$this->m_common->update_row('tbl_delivery_orders',array('do_id'=>$id),array('do_status'=>'Approved'));
         if(!empty($result)){
             redirect_with_msg('delivery_orders/index', 'Successfully Approved');
         }else{
             redirect_with_msg('delivery_orders/index', 'Not Approved');
         }
     }
     
     
     function close_delivery_order($id=false,$cust_id=false){

         $user_id=$this->session->userdata('user_id');
         $do_id=$this->input->post('do_id');
         $closing_reason=$this->input->post('closing_reason');


        // $result=$this->m_common->update_row('tbl_delivery_orders',array('do_id'=>$id),array('closing_status'=>'Closed','updated_by'=>$user_id));
        $result=$this->m_common->update_row('tbl_delivery_orders',array('do_id'=>$do_id),array('closing_status'=>'Closed','closing_reason'=>$closing_reason,'updated_by'=>$user_id));
         if(!empty($result)){
             if(!empty($cust_id)){
                redirect_with_msg('delivery_orders/index/'.$cust_id, 'Successfully Closed');
             }else{
                redirect_with_msg('delivery_orders/index', 'Successfully Closed'); 
             }
         }else{
             if(!empty($cust_id)){
                redirect_with_msg('delivery_orders/index/'.$cust_id, 'Not Closed');
             }else{
                redirect_with_msg('delivery_orders/index', 'Not Closed'); 
             }
         }
     }
     
     function open_delivery_order($id){
         $user_id=$this->session->userdata('user_id');
         $result=$this->m_common->update_row('tbl_delivery_orders',array('do_id'=>$id),array('closing_status'=>'Open','updated_by'=>$user_id));
         if(!empty($result)){
             redirect_with_msg('delivery_orders/index', 'Successfully Open');
         }else{
             redirect_with_msg('delivery_orders/index', 'Not Open');
         }
     }
     
     
     function reject_delivery_order($id){
         $result=$this->m_common->update_row('tbl_delivery_orders',array('do_id'=>$id),array('do_status'=>'Rejected'));
         if(!empty($result)){
             redirect_with_msg('delivery_orders/index', 'Successfully Rejected');
         }else{
             redirect_with_msg('delivery_orders/index', 'Not Rejected');
         }
     }
     
     
     function salesOrderInfoProjectWise(){
        $this->setOutputMode(NORMAL);
        $branch_id = $this->session->userdata('companyId');
        $project_id = $this->input->post('project_id');
        $data['order_info'] = $this->m_common->get_row_array('tbl_sales_orders', array('project_id' => $project_id,'delivery_order_status !='=>'Generated Delivery Order','is_active'=>1,'unit_id'=>$branch_id),'*');
        
        echo json_encode($data);
    }
   

}






