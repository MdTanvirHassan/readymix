<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sale_invoices extends Site_Controller {

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

    function index($cust_id=false){
         $branch_id = $this->session->userdata('companyId');
        $this->menu = 'trading';
        $this->sub_menu = 'rm_invoice';
        $this->sub_inner_menu = 'rm_invoice';
        $this->titlebackend("Sale Invoices");
        $customer_id=$this->input->post('customer_id');
        
        $f_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        
        
        if(!empty($f_date) & !empty($to_date)){
            $f_date = date('Y-m-d', strtotime($f_date));
            $to_date = date('Y-m-d', strtotime($to_date));
            $data['f_date'] = $f_date;
            $data['to_date'] = $to_date;
        }else if(!empty($f_date)){
            $f_date = date('Y-m-d', strtotime($f_date));
            $data['f_date'] = $f_date;
            $data['to_date'] = '';
        } else if (!empty($to_date)) {
            $to_date = date('Y-m-d', strtotime($to_date));
            $data['f_date'] = '';
            $data['to_date'] = $to_date;
        } else {
            $data['f_date'] = '';
            $data['to_date'] = '';
            $f_date = '';
            $to_date = '';
        }
        
        
        
        if(!empty($customer_id)){
            if($customer_id=="all"){
                $cust_id='';
            }else{
                $cust_id=$customer_id;
            }
        }
        
       if(!empty($cust_id)){  
           if(!empty($f_date) & !empty($to_date)){
               $sql = "select v.*,c.c_name,c.c_short_name,c.deposit,c.id as customer_id,sum(tsid.quantity) as total_qty,tsid.unit_price from rm_sales_invoices v left join rm_sales_invoice_details tsid on v.inv_id=tsid.inv_id left join tbl_customers c on v.customer_id=c.id  where (v.sale_invoice_date>='$f_date' and v.sale_invoice_date<='$to_date') and v.status!='Canceled' and v.status!='Received'  and v.is_active=1  and v.customer_id=" .$cust_id.' group by v.inv_id order by v.sale_invoice_date desc';
           }else if(!empty($f_date)){
               $sql = "select v.*,c.c_name,c.c_short_name,c.deposit,c.id as customer_id,sum(tsid.quantity) as total_qty,tsid.unit_price from rm_sales_invoices v left join rm_sales_invoice_details tsid on v.inv_id=tsid.inv_id left join tbl_customers c on v.customer_id=c.id  where v.sale_invoice_date>='$f_date' and v.status!='Canceled' and v.status!='Received'  and v.is_active=1  and v.customer_id=" .$cust_id.' group by v.inv_id order by v.sale_invoice_date desc';
           }else if(!empty($to_date)){
               $sql = "select v.*,c.c_name,c.c_short_name,c.deposit,c.id as customer_id,sum(tsid.quantity) as total_qty,tsid.unit_price from rm_sales_invoices v left join rm_sales_invoice_details tsid on v.inv_id=tsid.inv_id left join tbl_customers c on v.customer_id=c.id  where v.sale_invoice_date<='$to_date' and v.status!='Canceled' and v.status!='Received'  and v.is_active=1  and v.customer_id=" .$cust_id.' group by v.inv_id order by v.sale_invoice_date desc';
           }else{
                $sql = "select v.*,c.c_name,c.c_short_name,c.deposit,c.id as customer_id,sum(tsid.quantity) as total_qty,tsid.unit_price from rm_sales_invoices v left join rm_sales_invoice_details tsid on v.inv_id=tsid.inv_id left join tbl_customers c on v.customer_id=c.id  where v.status!='Canceled' and v.status!='Received'  and v.is_active=1  and v.customer_id=" .$cust_id.' group by v.inv_id order by v.sale_invoice_date desc';
           }     
           $data['invoices'] = $this->m_common->customeQuery($sql);
       }else{
           if(!empty($f_date) & !empty($to_date)){
               $sql = "select v.*,c.c_name,c.c_short_name,c.deposit,c.id as customer_id,sum(tsid.quantity) as total_qty,tsid.unit_price from rm_sales_invoices v left join rm_sales_invoice_details tsid on v.inv_id=tsid.inv_id left join tbl_customers c on v.customer_id=c.id  where (v.sale_invoice_date>='$f_date' and v.sale_invoice_date<='$to_date') and v.status!='Canceled' and v.status!='Received'  and v.is_active=1 group by v.inv_id order by v.sale_invoice_date desc";
           }else if(!empty($f_date)){
               $sql = "select v.*,c.c_name,c.c_short_name,c.deposit,c.id as customer_id,sum(tsid.quantity) as total_qty,tsid.unit_price from rm_sales_invoices v left join rm_sales_invoice_details tsid on v.inv_id=tsid.inv_id left join tbl_customers c on v.customer_id=c.id  where v.sale_invoice_date>='$f_date' and v.status!='Canceled' and v.status!='Received'  and v.is_active=1 group by v.inv_id order by v.sale_invoice_date desc";
           }else if(!empty($to_date)){
               $sql = "select v.*,c.c_name,c.c_short_name,c.deposit,c.id as customer_id,sum(tsid.quantity) as total_qty,tsid.unit_price from rm_sales_invoices v left join rm_sales_invoice_details tsid on v.inv_id=tsid.inv_id left join tbl_customers c on v.customer_id=c.id  where v.sale_invoice_date<='$to_date' and v.status!='Canceled' and v.status!='Received'  and v.is_active=1 group by v.inv_id order by v.sale_invoice_date desc";
           }else{
                $sql ="select v.*,c.c_name,c.c_short_name,c.deposit,c.id as customer_id,sum(tsid.quantity) as total_qty,tsid.unit_price from rm_sales_invoices v left join rm_sales_invoice_details tsid on v.inv_id=tsid.inv_id left join tbl_customers c on v.customer_id=c.id  where v.status!='Canceled' and v.status!='Received'  and v.is_active=1 group by v.inv_id order by v.sale_invoice_date desc limit 20";     
           }
           $data['invoices'] = $this->m_common->customeQuery($sql);
       }
       $data['customer_id']=$cust_id;
        
       if(!empty($data['invoices'])){
           foreach($data['invoices'] as $key=>$value){
               $d_sql="select rsid.*,rdo.delivery_no,il.lc_no from rm_sales_invoice_details rsid
                     left join rm_delivery_challan_details rdcd on rsid.dc_details_id=rdcd.dc_details_id 
                     left join rm_delivery_orders_details rdod on rdcd.do_details_id=rdod.do_details_id
                     left join rm_delivery_orders rdo on rdod.do_id=rdo.do_id
                     left join import_lc_details ild on rdod.lc_details_id=ild.id
                     left join import_lc il on ild.lc_id=il.lc_id
                     where rsid.inv_id=".$value['inv_id'];
               $do_info=$this->m_common->customeQuery($d_sql);
               if(!empty($do_info)){
                   $data['invoices'][$key]['delivery_order_no']=$do_info[0]['delivery_no'];
                   $data['invoices'][$key]['lc_no']=$do_info[0]['lc_no'];
                   
               }
               
           }
       }
    
        
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1,'customer_category'=>'Raw Material'),'*','','','c_name');         
        $this->load->view('raw_materials/sale_invoices/v_sale_invoice', $data);
    }
    
    
    function paidInvoice($cust_id=false){
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'paid_sales_invoice';
        $this->titlebackend("Sale Invoices");
        $customer_id=$this->input->post('customer_id');
        if(!empty($customer_id)){
            if($customer_id=="all"){
                $cust_id='';
            }else{
                $cust_id=$customer_id;
            }
        }
        if(!empty($cust_id)){
            
                 $sql = "select v.*,o.order_no,do.delivery_no,c.c_name,c.c_short_name,c.deposit,c.id as customer_id,tpc.category_name,tp.project_name as tp_project_name,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name from rm_sales_invoices v left join rm_sales_invoice_details tsid on v.inv_id=tsid.inv_id left join tbl_delivery_orders do on v.do_id=do.do_id left join tbl_sales_orders o on do.o_id=o.o_id left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on v.customer_id=c.id left join tbl_product_categories tpc on v.category_id=tpc.category_id left join tbl_project tp on v.project_id=tp.project_id where v.status='Received'  and v.is_active=1 and v.unit_id=" . $branch_id . " and v.customer_id=" .$cust_id.' group by v.inv_id order by v.sale_invoice_date desc';
          $data['invoices'] = $this->m_common->customeQuery($sql);
       }else{
           $sql = "select v.*,o.order_no,do.delivery_no,c.c_name,c.c_short_name,c.deposit,c.id as customer_id,tpc.category_name,tp.project_name as tp_project_name,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name from rm_sales_invoices v left join rm_sales_invoice_details tsid on v.inv_id=tsid.inv_id left join tbl_delivery_orders do on v.do_id=do.do_id left join tbl_sales_orders o on do.o_id=o.o_id left join tbl_sales_quotation q on o.q_id=q.q_id left join tbl_customers c on v.customer_id=c.id left join tbl_product_categories tpc on v.category_id=tpc.category_id left join tbl_project tp on v.project_id=tp.project_id where v.status='Received' and v.is_active=1 and v.unit_id=" . $branch_id . ' group by v.inv_id order by v.sale_invoice_date desc';        
           $data['invoices'] = $this->m_common->customeQuery($sql);
           //echo '<pre>';print_r($data['invoices']);exit;
       }
       $data['customer_id']=$cust_id;
        

        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');         
        $this->load->view('raw_materials/sale_invoices/v_paid_sales_invoice', $data);
    }
    
    
    
    
    function get_customer_balance(){
        $this->setOutputMode(NORMAL);
        $id=$this->input->post('customer_id');
        $customer_info=$this->m_common->get_row_array('tbl_customers',array('id'=>$id),'*');
        $t_re ="select sum(amount) as total_amount from tbl_payment_collections pc  where pc.is_active=1 and pc.payment_status='Received' and pc.customer_id=".$id;
        $total_received= $this->m_common->customeQuery($t_re);
            
        $total_deposit=$total_received[0]['total_amount']+$customer_info[0]['opening_balance']; 
        
        $tb_sql="select sum(received_amount) as total_received from rm_sales_invoices v where v.status!='Canceled' and v.is_active=1 and v.customer_id=".$id;
        $total_bill=$this->m_common->customeQuery($tb_sql);
        $net_balance=$total_deposit-$total_bill[0]['total_received']; 
        if($net_balance>0){
            $data['customer_balance']=round($net_balance,2);
        }else{
            $data['customer_balance']=0;
        }
        echo json_encode($data);
    }
    
    function cancelInvoice($id,$cust_id=false){
         $user_id=$this->session->userdata('user_id');
         $result=$this->m_common->update_row('rm_sales_invoices',array('inv_id'=>$id),array('status'=>'Canceled','updated_by'=>$user_id,'updated_date'=>date('Y-m-d')));
         if(!empty($result)){
             if(!empty($cust_id)){
                redirect_with_msg('raw_materials/sale_invoices/index/'.$cust_id, 'Successfully Canceled');
             }else{
                redirect_with_msg('raw_materials/sale_invoices/index', 'Successfully Canceled'); 
             }
         }else{
             if(!empty($cust_id)){
                redirect_with_msg('raw_materials/sale_invoices/index/'.$cust_id, 'Not Cancel');
             }else{
                redirect_with_msg('raw_materials/sale_invoices/index', 'Not Cancel'); 
             }
         }
     }

    function add_sale_invoice() {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'trading';
        $this->sub_menu = 'sale_invoice';
        $this->sub_inner_menu = 'sale_invoice';

        $this->titlebackend("Quotation Information");
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1,'customer_category'=>'Raw Material'),'*','','','c_name');
        

        
        foreach ($data['customers'] as $key => $value){
            $challan_info = array();
            $challan_sql = "select dcd.* from rm_delivery_challan_details dcd left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on dc.do_id=do.do_id  where dc.status='Approved' and dcd.bill_status='Pending' and dc.customer_id=".$value['id'];
            $challan_info = $this->m_common->customeQuery($challan_sql);
            if (empty($challan_info)){
                unset($data['customers'][$key]);
            } 
        }
        
        
        
        $this->load->view('raw_materials/sale_invoices/v_add_sale_invoice', $data);
      
    }

    
    
    
    
    function salesOrderInfoProjectWise(){
        $this->setOutputMode(NORMAL);
        $branch_id = $this->session->userdata('companyId');
        $project_id = $this->input->post('project_id');
        $data['order_info'] = $this->m_common->get_row_array('tbl_sales_orders', array('project_id' => $project_id,'unit_id'=>$branch_id,'is_active'=>1),'*');
        $i=0;
        foreach($data['order_info'] as $key => $value){
            $challan_info = array();
            $challan_sql = "select dcd.* from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on dc.do_id=do.do_id left join tbl_sales_orders tso on do.o_id=tso.o_id where dcd.bill_status='Pending' and tso.o_id=" . $value['o_id'];
            $challan_info = $this->m_common->customeQuery($challan_sql);
            if (empty($challan_info)){
              //  unset($data['order_info'][$key]);
            }else{
               $data['so_order_info'][$i]=$data['order_info'][$key]; 
               $i++;
            } 
        }
        echo json_encode($data);
    }
    
    
    
    function deliveryOrderInfoCustomerWise() {
        $this->setOutputMode(NORMAL);
        $customer_id = $this->input->post('customer_id');
        $data['order_info'] = $this->m_common->get_row_array('rm_delivery_orders',array('customer_id'=>$customer_id),'*');
        $i=0;
        foreach ($data['order_info'] as $key => $value){
            $challan_info = array();
            $challan_sql = "select dcd.*,do.do_id from rm_delivery_challan_details dcd left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id left join rm_delivery_orders do on dod.do_id=do.do_id where dcd.bill_status='Pending' and do.do_id=".$value['do_id'];
            $challan_info = $this->m_common->customeQuery($challan_sql);
            if (empty($challan_info)){
                unset($data['order_info'][$key]);
            }else{
               $data['do_order_info'][$i]=$data['order_info'][$key]; 
               $i++;
            }  
        }
        echo json_encode($data);
    }
    
    function add_sale_invoice_action(){
        $user_id=$this->session->userdata('user_id');
        $branch_id = $this->session->userdata('companyId');
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            if (empty($postData['select_product'])) {
                redirect_with_msg('raw_materials/sale_invoices/add_sale_invoice', 'Please Select Product');
            }


           
           

            if(!empty($postData['customer_id'])){
                $insertData['customer_id']=$postData['customer_id'];               
            }  

                        
            if (!empty($postData['do_id'])) {
                $insertData['do_id'] = $postData['do_id'];
                $o_id = $postData['do_id'];
            }
            
            if(!empty($postData['inv_no'])){
                $insertData['inv_no'] = $postData['inv_no'];                
                $pre_invoice_info=$this->m_common->get_row_array('rm_sales_invoices',array('inv_no'=>$postData['inv_no'],'is_active'=>1),'*');
                if(!empty($pre_invoice_info)){
                    redirect_with_msg('raw_materials/sale_invoices', 'This invoice already exists');
                }
            }
            if (!empty($postData['sale_invoice_date'])) {
                $insertData['sale_invoice_date'] = date('Y-m-d', strtotime($postData['sale_invoice_date']));
            }
            if (!empty($postData['attention'])) {
                $insertData['attention'] = $postData['attention'];
            }
            if (!empty($postData['phone'])) {
                $insertData['phone'] = $postData['phone'];
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
            if (!empty($postData['sub_total_amount'])) {
                $insertData['actual_amount'] = $postData['sub_total_amount'];
            }
            if (!empty($postData['discount'])) {
                $insertData['discount'] = $postData['discount'];
            }



            $status="Pending";
            $insertData['branch_id'] = $branch_id;
            $insertData['is_active'] = 1;
            $insertData['status']=$status;
            $insertData['created_by']=$user_id;
            $insertData['created_date'] = date('Y-m-d');
            $result = $this->m_common->insert_row('rm_sales_invoices', $insertData);
            if(!empty($result)){
                

                

                foreach ($postData['s_item_id'] as $key => $each) {
                    if(in_array($key,$postData['select_product'])){
                        $insertData1 = array();
                        $insertData1['inv_id'] = $result;
                        $insertData1['s_item_id'] = $each;
                        $insertData1['is_active'] = 1;


                        if (empty($each)) {
                            continue;
                        }




                        $insertData1['received_status'] = 'Pending';
                        if (!empty($postData['dc_id'][$key])) {
                            $insertData1['dc_id'] = $postData['dc_id'][$key];
                        }
                        
                        
                        if(!empty($postData['dc_details_id'][$key])){
                            $insertData1['dc_details_id'] = $postData['dc_details_id'][$key];
                        }
                        
                        
                        if (!empty($postData['quantity'][$key])) {
                            $insertData1['quantity'] = $postData['quantity'][$key];
                        }
                        if (!empty($postData['unit_price'][$key])) {
                            $insertData1['unit_price'] = $postData['unit_price'][$key];
                        }

                        

                        if (!empty($postData['amount'][$key])) {
                            $insertData1['amount'] = $postData['amount'][$key];
                        }

                        $r = $this->m_common->insert_row('rm_sales_invoice_details',$insertData1);
                        if (!empty($r)) {
                            $this->m_common->update_row('rm_delivery_challan_details',array('dc_details_id'=>$postData['dc_details_id'][$key]),array('bill_status' =>"Generated"));
                        }
                    }
                }
                redirect_with_msg('raw_materials/sale_invoices', 'Successfully Inserted');
            }
        } else {
            redirect_with_msg('raw_materials/sale_invoices/add_sale_invoice', 'Please fill the form and submit');
        }
    }
    
    
    
    
    
    function add_sale_invoice_action_new() {
        $branch_id = $this->session->userdata('companyId');
        $postData = $this->input->post();
        if (!empty($postData)){
            
            
            $insertData = array();
            if (empty($postData['select_product'])) {
                redirect_with_msg('raw_materials/sale_invoices/add_sale_invoice', 'Please Select Product');
            }


            if(!empty($postData['do_id'])){
                $insertData['do_id']=$postData['do_id'];
                $o_id = $postData['do_id'];
            }
            
            if(!empty($postData['inv_no'])){
                $insertData['inv_no'] = $postData['inv_no'];
                $pre_invoice_info=$this->m_common->get_row_array('rm_sales_invoices',array('inv_no'=>$postData['inv_no'],'is_active'=>1),'*');
                if(!empty($pre_invoice_info)){
                    redirect_with_msg('raw_materials/sale_invoices', 'This invoice already exists');
                }
            }
            
            if (!empty($postData['sale_invoice_date'])) {
                $insertData['sale_invoice_date'] = date('Y-m-d', strtotime($postData['sale_invoice_date']));
            }
            if (!empty($postData['attention'])) {
                $insertData['attention'] = $postData['attention'];
            }
            if (!empty($postData['phone'])) {
                $insertData['phone'] = $postData['phone'];
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
            
            
            if (!empty($postData['sub_total_amount'])){
                $insertData['actual_amount']=$postData['sub_total_amount'];
            }
            
            
            if (!empty($postData['discount'])) {
                $insertData['discount'] = $postData['discount'];
            }

           

            $status = "Pending";
            $insertData['branch_id'] = $branch_id;
            $insertData['is_active'] = 1;
            $insertData['status'] = $status;
            $insertData['created_date'] = date('Y-m-d');
            $result = $this->m_common->insert_row('rm_sales_invoices', $insertData);
            if (!empty($result)) {
                

                foreach ($postData['s_item_id'] as $key => $each) {
                    if (in_array($key, $postData['select_product'])){
                        $insertData1 = array();
                        $insertData1['inv_id'] = $result;
                        $insertData1['s_item_id'] = $each;
                        $insertData1['is_active'] = 1;


                        if (empty($each)) {
                            continue;
                        }


                        

                        $insertData1['received_status'] = 'Pending';
                        if (!empty($postData['dc_id'][$key])) {
                            $insertData1['dc_id'] = $postData['dc_id'][$key];
                        }
                        
                        if(!empty($postData['dc_details_id'][$key])){
                            $insertData1['dc_details_id'] = $postData['dc_details_id'][$key];
                        }
                        
                        if (!empty($postData['quantity'][$key])) {
                            $insertData1['quantity'] = $postData['quantity'][$key];
                        }
                        if (!empty($postData['unit_price'][$key])) {
                            $insertData1['unit_price'] = $postData['unit_price'][$key];
                        }
                        
                        if (!empty($postData['amount'][$key])) {
                            $insertData1['amount'] = $postData['amount'][$key];
                        }

                        $r=$this->m_common->insert_row('rm_sales_invoice_details', $insertData1);
                        if (!empty($r)) {
                            $this->m_common->update_row('rm_delivery_challan_details',array('dc_details_id' =>$postData['dc_details_id'][$key]),array('bill_status' =>"Generated"));
                        }
                    }
                }
                redirect_with_msg('raw_materials/sale_invoices', 'Successfully Inserted');
            }
        } else {
            redirect_with_msg('raw_materials/sale_invoices/add_sale_invoice', 'Please fill the form and submit');
        }
    }

    
   
    
    function edit_sale_invoice($id) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'trading';
        $this->sub_menu = 'rm_invoice';
        $this->sub_inner_menu = 'sale_invoice';

        $this->titlebackend("Invoice Information");
        
        $sql = "select do.*,c.c_name,c.c_short_name from rm_delivery_orders do  left join tbl_customers c on do.customer_id=c.id where do.is_active=1 and (do.status='Delivered' or do.status='Partially Delivered') ";
        $data['orders'] = $this->m_common->customeQuery($sql);
        $data['sale_invoice_info'] = $this->m_common->get_row_array('rm_sales_invoices', array('inv_id' => $id), '*');
        
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('id'=>$data['sale_invoice_info'][0]['customer_id'],'customer_category'=>'Raw Material'),'*','','','c_name');
        
//        $sql = "select d.*,dcd.dc_details_id,p.item_name,dc.dc_no,dc.delivery_challan_date,tmu.meas_unit,do.delivery_no from rm_sales_invoice_details d
//        left join rm_items p on d.s_item_id=p.id 
//        left join rm_delivery_challans dc on d.dc_id=dc.dc_id 
//        join rm_delivery_challan_details dcd on dcd.dc_id=dc.dc_id 
//        left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id
//        left join rm_delivery_orders `do` on `dod`.do_id=do.do_id 
//        left join tbl_measurement_unit tmu on p.mu_id=tmu.id 
//        where d.is_active=1 and inv_id=" . $id;
        
        
        $sql = "select d.*,dcd.dc_details_id,p.item_name,dc.dc_no,dc.delivery_challan_date,tmu.meas_unit,do.delivery_no from rm_sales_invoice_details d
        left join rm_items p on d.s_item_id=p.id 
        left join rm_delivery_challan_details dcd on d.dc_details_id=dcd.dc_details_id 
        left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id  
        left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id
        left join rm_delivery_orders `do` on `dod`.do_id=do.do_id 
        left join tbl_measurement_unit tmu on p.mu_id=tmu.id 
        where d.is_active=1 and inv_id=" . $id;
        
        
        
        $data['sale_invoice_details_info'] = $this->m_common->customeQuery($sql);
        

        
       
        $sql = "select dcd.*,p.item_name,tmu.meas_unit,dc.dc_no,dc.delivery_challan_date,do.delivery_no 
from rm_delivery_challan_details dcd
left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id
left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id
left join rm_delivery_orders `do` on `dod`.do_id=do.do_id 
left join  rm_items p on dcd.s_item_id=p.id 
left join tbl_measurement_unit tmu on p.mu_id=tmu.id
where dc.status='Approved' 
and dcd.bill_status='Pending' and dcd.is_active=1 and do.do_location='Yard' and dc.customer_id=".$data['sale_invoice_info'][0]['customer_id']." order by dc.dc_id";
        
        
        
        
        
        
        $data['item_list'] = $this->m_common->customeQuery($sql);
        

        
        
        foreach ($data['item_list'] as $key => $value) {
            $data['item_list'][$key]['delivery_challan_date'] = date('d-m-Y', strtotime($value['delivery_challan_date']));
        }
                
        $this->load->view('raw_materials/sale_invoices/v_edit_sale_invoice', $data);
    }

    function edit_sale_invoice_action($inv_id){
        $user_id=$this->session->userdata('user_id');
        $postData = $this->input->post();
        if (!empty($postData)) {
            $insertData = array();
            
                    
             
            if (!empty($postData['do_id'])) {
                $insertData['do_id'] = $postData['do_id'];
                $o_id = $postData['do_id'];
            }

            $invoice_pre_info = $this->m_common->get_row_array('rm_sales_invoices', array('inv_id' => $inv_id), '*');
          //  $sql = "select * from tbl_delivery_orders where do_id=" . $postData['do_id'];
          //  $so_id = $this->m_common->customeQuery($sql);
            

            if (!empty($postData['sale_invoice_date'])) {
                $insertData['sale_invoice_date'] = date('Y-m-d', strtotime($postData['sale_invoice_date']));
            }
            if (!empty($postData['attention'])) {
                $insertData['attention'] = $postData['attention'];
            }
            if (!empty($postData['phone'])) {
                $insertData['phone'] = $postData['phone'];
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
            if (!empty($postData['sub_total_amount'])) {
                $insertData['actual_amount'] = $postData['sub_total_amount'];
            }
            if (!empty($postData['discount'])) {
                $insertData['discount'] = $postData['discount'];
            }


            
            $insertData['updated_by']=$user_id;
            $insertData['updated_date'] = date('Y-m-d');
            

            $result = $this->m_common->update_row('rm_sales_invoices', array('inv_id' => $inv_id), $insertData);
            if ($result >= 0) {
                
                $exists = $this->m_common->get_row_array('rm_sales_invoice_details',array('inv_id'=>$inv_id),'dc_details_id');
                foreach($exists as $r){
                    $this->m_common->update_row('rm_delivery_challan_details',array('dc_details_id'=>$r['dc_details_id']),array('bill_status'=>'Pending'));
                }
                $this->m_common->delete_row('rm_sales_invoice_details', array('inv_id' => $inv_id));
                

                
                foreach ($postData['s_item_id'] as $key => $each) {
                    
                    
                    if(in_array($key,$postData['select_product'])){
                        $insertData1 = array();
                        $insertData1['inv_id'] = $inv_id;
                        $insertData1['s_item_id'] = $postData['s_item_id'][$key];
                        $insertData1['is_active'] = 1;

                        
                        if (empty($postData['s_item_id'][$key])) {
                            continue;
                        }

                        $insertData1['received_status'] = 'Pending';
                        if (!empty($postData['dc_id'][$key])) {
                            $insertData1['dc_id'] = $postData['dc_id'][$key];
                        }


                        if(!empty($postData['dc_details_id'][$key])){
                            $insertData1['dc_details_id'] = $postData['dc_details_id'][$key];
                        }

                        if (!empty($postData['quantity'][$key])) {
                            $insertData1['quantity'] = $postData['quantity'][$key];
                        }
                        if (!empty($postData['unit_price'][$key])) {
                            $insertData1['unit_price'] = $postData['unit_price'][$key];
                        }


                        if (!empty($postData['amount'][$key])) {
                            $insertData1['amount'] = $postData['amount'][$key];
                        }

                        $result = $this->m_common->insert_row('rm_sales_invoice_details', $insertData1);
                        if (!empty($result)) {
                            $this->m_common->update_row('rm_delivery_challan_details', array('dc_details_id' => $postData['dc_details_id'][$key]), array('bill_status' => "Generated"));
                        }
                    }    
                }
                redirect_with_msg('raw_materials/sale_invoices', 'Successfully Updated');
            }
        } else {
            redirect_with_msg('raw_materials/sale_invoices/add_sale_invoice', 'Please fill the form and submit');
        }
    }
    
    
    
    

    function details_sale_invoice($id, $print = false) {
        $branch_id = $this->session->userdata('companyId');
        $this->menu = 'trading';
        $this->sub_menu = 'rm_invoice';
        $this->sub_inner_menu = 'sale_invoice';
        $this->titlebackend("Invoice Information");
        
        
        
        $in_sql="select ri.*,tc.c_name,tc.c_contact_person,tc.c_mobile_no from rm_sales_invoices ri left join tbl_customers tc on ri.customer_id=tc.id where ri.inv_id=".$id;
        $data['sale_invoice_info']=$this->m_common->customeQuery($in_sql);
        
//        $sql = "select d.*,dcd.dc_details_id,p.item_name,dc.dc_no,dc.delivery_challan_date,tmu.meas_unit,do.delivery_no from rm_sales_invoice_details d
//        left join rm_items p on d.s_item_id=p.id 
//        left join rm_delivery_challans dc on d.dc_id=dc.dc_id 
//        join rm_delivery_challan_details dcd on dcd.dc_id=dc.dc_id 
//        left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id
//        left join rm_delivery_orders `do` on `dod`.do_id=do.do_id 
//        left join tbl_measurement_unit tmu on p.mu_id=tmu.id 
//        where d.is_active=1 and inv_id=" . $id;
        
//        $sql = "select d.*,dcd.dc_details_id,p.item_name,dc.dc_no,dc.delivery_challan_date,tmu.meas_unit,do.delivery_no from rm_sales_invoice_details d
//        left join rm_items p on d.s_item_id=p.id 
//        left join rm_delivery_challan_details dcd on d.dc_details_id=dcd.dc_details_id 
//        left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id 
//        left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id
//        left join rm_delivery_orders `do` on `dod`.do_id=do.do_id 
//        left join tbl_measurement_unit tmu on p.mu_id=tmu.id 
//        where d.is_active=1 and inv_id=" . $id;
        
        
        $sql = "select d.*,dcd.dc_details_id,p.item_name,dc.dc_no,dc.delivery_challan_date,tmu.meas_unit,do.delivery_no,dod.transport_cost from rm_sales_invoice_details d
        left join rm_items p on d.s_item_id=p.id 
        left join rm_delivery_challan_details dcd on d.dc_details_id=dcd.dc_details_id 
        left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id 
        left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id
        left join rm_delivery_orders `do` on `dod`.do_id=do.do_id 
        left join tbl_measurement_unit tmu on p.mu_id=tmu.id 
        where d.is_active=1 and inv_id=" . $id;
        
        
        $data['sale_invoice_details_info'] = $this->m_common->customeQuery($sql);
        $sql = "select count(*) as sl from rm_sales_invoices where inv_id <= $id and is_active=1";
        $data['sl'] = $this->m_common->customeQuery($sql);
        if ($print == false) {
            $this->load->view('raw_materials/sale_invoices/v_details_sale_invoice', $data);
        } else {
            $html = $this->load->view('raw_materials/sale_invoices/print_sale_invoice', $data, true);
            echo $html;
            exit;
        }
    }

    function delete_sale_invoice($id) {
        if(!empty($id)){
            $do_id=$this->m_common->get_row_array('rm_sales_invoices', array('inv_id' => $id), '*');
            $res=$this->m_common->update_row('rm_sales_invoices', array('inv_id' => $id), array('is_active' => 0));
            if(!empty($res)){
                $this->m_common->update_row('rm_sales_invoice_details', array('inv_id' => $id), array('is_active' => 0));
                $exists = $this->m_common->get_row_array('rm_sales_invoice_details',array('inv_id'=>$id),'dc_details_id');
                foreach($exists as $r){
                    $this->m_common->update_row('rm_delivery_challan_details',array('dc_details_id'=>$r['dc_details_id']),array('bill_status'=>'Pending'));
                }
                redirect_with_msg('raw_materials/sale_invoices/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('raw_materials/sale_invoices/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/sale_invoices/index', 'Please click on delete button');
        }
    }

    
    
   function customerWiseChallan() {
        $branch_id = $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
        $customer_id=$this->input->post('customer_id');
        
        $data['order_info'] = $this->m_common->get_row_array('rm_delivery_orders',array('customer_id'=>$customer_id,'do_location'=>'Yard'),'*');
        $i=0;
        foreach ($data['order_info'] as $key => $value){
            $challan_info = array();
            $challan_sql = "select dcd.*,do.do_id from rm_delivery_challan_details dcd left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id left join rm_delivery_orders do on dod.do_id=do.do_id where dcd.bill_status='Pending' and do.do_id=".$value['do_id'];
            $challan_info = $this->m_common->customeQuery($challan_sql);
            if (empty($challan_info)){
                unset($data['order_info'][$key]);
            }else{
               $data['do_order_info'][$i]=$data['order_info'][$key]; 
               $i++;
            }  
        }
        
        //$test=$data['do_order_info'];
        
        $data['branch_info'] = $this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
       
        $data['customer_info']=$this->m_common->get_row_array('tbl_customers',array('id'=>$customer_id),'*');
        
        $total_invoice=$this->m_common->get_row_array('rm_sales_invoices',array('customer_id'=>$customer_id,'is_active'=>1),'*');
        $data['invoice_code'] =count($total_invoice);
        
        $sql = "select dcd.*,p.item_name,tmu.meas_unit,dc.dc_no,dc.delivery_challan_date,do.delivery_no 
from rm_delivery_challan_details dcd
left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id
left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id
left join rm_delivery_orders `do` on `dod`.do_id=do.do_id 
left join  rm_items p on dcd.s_item_id=p.id 
left join tbl_measurement_unit tmu on p.mu_id=tmu.id
where dc.status='Approved' 
and dcd.bill_status='Pending' and dcd.is_active=1 and do.do_location='Yard' and dc.customer_id=".$customer_id.' order by dc.dc_id';
        $data['item_list'] = $this->m_common->customeQuery($sql);
        foreach ($data['item_list'] as $key => $value) {
            $data['item_list'][$key]['delivery_challan_date'] = date('d-m-Y', strtotime($value['delivery_challan_date']));
        }
        echo json_encode($data);
    }
    
    function get_order_item() {
        $branch_id = $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
        $do_id = $this->input->post('do_id');
        $data['branch_info'] = $this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
        $d_sql = "select do.*,c.id,c.c_short_name from rm_delivery_orders do left join tbl_customers c on do.customer_id=c.id where do.do_id=" . $do_id;
        $data['order_info'] = $this->m_common->customeQuery($d_sql);


        $total_invoice=$this->m_common->get_row_array('rm_sales_invoices',array('customer_id' => $data['order_info'][0]['id'],'is_active'=>1),'*');
        $data['invoice_code'] =count($total_invoice);
        
        $sql = "select dcd.*,p.item_name,tmu.meas_unit,dc.dc_no,dc.delivery_challan_date,do.delivery_no 
from rm_delivery_challan_details dcd
left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id
left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id
left join rm_delivery_orders `do` on `dod`.do_id=do.do_id 
left join  rm_items p on dcd.s_item_id=p.id 
left join tbl_measurement_unit tmu on p.mu_id=tmu.id
where dc.status='Approved' 
and dcd.bill_status='Pending' and dcd.is_active=1 and dod.do_id=" . $do_id.' order by dc.dc_id';
        $data['item_list'] = $this->m_common->customeQuery($sql);
        foreach ($data['item_list'] as $key => $value) {
            $data['item_list'][$key]['delivery_challan_date'] = date('d-m-Y', strtotime($value['delivery_challan_date']));
        }
        echo json_encode($data);
    }
    
    function get_order_item_new() {
        $branch_id = $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
        $customer_id = $this->input->post('customer_id');
        $project_id = $this->input->post('project_id');
        $o_id = $this->input->post('o_id');
        $do_id = $this->input->post('do_id');
        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        
        $where='';
        $where="and so.unit_id=$branch_id";
        if(!empty($o_id)){
            $where.=" and so.o_id=$o_id"; 
        }
        if(!empty($do_id)){
            $where.=" and do.do_id=$do_id"; 
        }
        if(!empty($from_date) & !empty($to_date)){
            $where.=" and dc.delivery_challan_date>='".date('Y-m-d',strtotime($from_date))."' and dc.delivery_challan_date<='".date('Y-m-d',strtotime($to_date))."'"; 
        }  elseif(!empty($from_date)){
           $where.=" and dc.delivery_challan_date>='".date('Y-m-d',strtotime($from_date))."'"; 
        }elseif(!empty($to_date)) {
           $where.=" and dc.delivery_challan_date<='".date('Y-m-d',strtotime($to_date))."'";
        }
       
        
        $d_sql = "select do.*,c.id,c.c_short_name,so.advance_received,so.adjusted_advance_to_bill from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id where do.o_id=" . $o_id;
        $data['order_info'] = $this->m_common->customeQuery($d_sql);


        //$data['invoice_code']=$this->m_common->get_row_array('tbl_invoice_code',array('customer_id'=>$data['order_info'][0]['id']),'*','',1,'id','DESC');
        $data['invoice_code'] = $this->m_common->get_row_array('tbl_invoice_code', array('customer_id' => $data['order_info'][0]['id'], 'unit_id' => $branch_id), '*', '', 1, 'id', 'DESC');
        //$sql="select d.*,i.s_item_name from tbl_sales_order_details d left join tbl_sales_items i on d.s_item_id=i.s_item_id where d.is_active=1 and d.o_id=".$o_id;
        //  $sql="select dcd.*,p.product_name,p.measurement_unit,dc.dc_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join  tbl_sales_products p on dcd.s_item_id=p.product_id where dcd.is_active=1 and dc.do_id=".$do_id;
        //  $sql="select dcd.*,p.product_name,p.measurement_unit,dc.dc_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join  tbl_sales_products p on dcd.s_item_id=p.product_id where dcd.bill_status='Pending' and dcd.is_active=1 and dc.do_id=".$do_id;
        $sql = "select dcd.*,sd.quantity as so_qty,p.product_name,p.measurement_unit,dc.dc_no,dc.delivery_challan_date 
from tbl_delivery_challan_details dcd
left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id 
left join  tbl_sales_products p on dcd.s_item_id=p.product_id 
left join tbl_delivery_orders `do` on `do`.do_id=dc.do_id 
left join tbl_sales_orders so on so.o_id=`do`.o_id
LEFT JOIN tbl_sales_order_details sd on so.o_id=sd.o_id and sd.product_id=dcd.s_item_id
where dc.status='Approved' 
and dcd.bill_status='Pending' and dcd.is_active=1 " . $where.' order by dc.dc_id';
        $data['item_list'] = $this->m_common->customeQuery($sql);
        foreach ($data['item_list'] as $key => $value) {
            $data['item_list'][$key]['delivery_challan_date'] = date('d-m-Y', strtotime($value['delivery_challan_date']));
        }
        echo json_encode($data);
    }

    function confirm_payment(){
        try {
            $this->db->trans_start();
            $branch_id=$this->session->userdata('companyId');
            $this->setOutputMode(NORMAL);
            $id = $this->input->post('id');
            $amt = $this->input->post('amt');
            $inv_type = $this->input->post('inv_type');
            
            $invoice_info = $this->m_common->get_row_array('rm_sales_invoices', array('inv_id' => $id), '*');
            $sql = "select * from rm_sales_invoice_details where (received_status='Pending' or received_status='Partial Received') and inv_id=" . $id;
            $invoice_details_info = $this->m_common->customeQuery($sql);
            $collection_amount = $amt;
            foreach($invoice_details_info as $key => $inv_detail){
                if($collection_amount <= 0){
                    break;
                }
                $r_amount = $inv_detail['amount'] - $inv_detail['received_amount'];
                if ($collection_amount < $r_amount) {
                    $r_amount = $collection_amount;
                }

                $net_r_amount=$inv_detail['received_amount']+$r_amount;

                if ($net_r_amount == $inv_detail['amount']){
                    $r_status = "Received";
                } else {
                    $r_status = "Partial Received";
                }
                // $this->m_common->update_row('rm_sales_invoice_details',array('inv_id'=>$collection_info[0]['invoice_id'],'s_item_id'=>$inv_detail['s_item_id']),array('received_amount'=>$net_r_amount,'received_status'=>$r_status));
                $this->m_common->update_row('rm_sales_invoice_details', array('inv_details_id' => $inv_detail['inv_details_id']), array('received_amount' => $net_r_amount, 'received_status' => $r_status));
                $collection_amount = $collection_amount - $r_amount;
            }
            
            $receive_amount = $amt + $invoice_info[0]['received_amount'];
            if ($receive_amount >= $invoice_info[0]['total_amount']) {
                $status = 'Received';
            } else {
                $status = 'Partial Received';
            }
            if($inv_type=="Direct"){
                $this->m_common->update_row('rm_sales_invoices', array('inv_id' => $id), array('received_amount' =>$receive_amount,'status' =>$status));               
                $sql = "update tbl_customers set deposit=deposit-" . $amt . " where id=" . $invoice_info[0]['customer_id'];
                $this->m_common->customeUpdate($sql);
            }else if($inv_type=="Pump"){
                $this->m_common->update_row('rm_sales_invoices', array('inv_id' => $id), array('received_amount' =>$receive_amount,'status' =>$status));               
                $sql = "update tbl_customers set deposit=deposit-" . $amt . " where id=" . $invoice_info[0]['customer_id'];
                $this->m_common->customeUpdate($sql);              
            }else{
                $this->m_common->update_row('rm_sales_invoices', array('inv_id' => $id), array('received_amount' =>$receive_amount,'status' => $status));
                $order_info = $this->m_common->customeQuery('select s.* from tbl_sales_orders s join tbl_delivery_orders d on d.o_id=s.o_id where d.do_id=' . $invoice_info[0]['do_id']);
                $net_advance_received = $order_info[0]['advance_received'] + $amt;
                $net_receive_amount = $order_info[0]['receive_amount'] + $amt;
                
                $sql = "update tbl_customers set deposit=deposit-" . $amt . " where id=" . $order_info[0]['customer_id'];
                $this->m_common->customeUpdate($sql);
            }

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_complete();
            }
            echo 'success';
        } catch (UserException $error) {
            $this->db->trans_rollback();
            echo '<pre>';
            print_r($error);
            exit;
            redirect_with_msg('payment_collections/add_collection', 'Something went wrong');
        }
    }
    
    function confirm_payment_04_07_2020(){
        try {
            $this->db->trans_start();
            $branch_id = $this->session->userdata('companyId');
            $this->setOutputMode(NORMAL);
            $id = $this->input->post('id');
            $amt = $this->input->post('amt');
            $invoice_info = $this->m_common->get_row_array('rm_sales_invoices', array('inv_id' => $id), '*');
            $sql = "select * from rm_sales_invoice_details where (received_status='Pending' or received_status='Partial Received') and inv_id=" . $id;
            $invoice_details_info = $this->m_common->customeQuery($sql);
            $collection_amount = $amt;
            foreach($invoice_details_info as $key => $inv_detail){
                if($collection_amount <= 0){
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
                // $this->m_common->update_row('rm_sales_invoice_details',array('inv_id'=>$collection_info[0]['invoice_id'],'s_item_id'=>$inv_detail['s_item_id']),array('received_amount'=>$net_r_amount,'received_status'=>$r_status));
                $this->m_common->update_row('rm_sales_invoice_details', array('inv_details_id' => $inv_detail['inv_details_id']), array('received_amount' => $net_r_amount, 'received_status' => $r_status));
                $collection_amount = $collection_amount - $r_amount;
            }
            $receive_amount = $amt + $invoice_info[0]['received_amount'];
            if ($receive_amount >= $invoice_info[0]['total_amount']) {
                $status = 'Received';
            } else {
                $status = 'Partial Received';
            }
            $this->m_common->update_row('rm_sales_invoices', array('inv_id' => $id), array('received_amount' =>$receive_amount,'status' => $status));
            $order_info = $this->m_common->customeQuery('select s.* from tbl_sales_orders s join tbl_delivery_orders d on d.o_id=s.o_id where d.do_id=' . $invoice_info[0]['do_id']);
            $net_advance_received = $order_info[0]['advance_received'] + $amt;
            $net_receive_amount = $order_info[0]['receive_amount'] + $amt;
            $this->m_common->update_row('tbl_sales_orders', array('o_id' => $order_info[0]['o_id']), array('receive_amount' => $net_receive_amount, 'advance_received' => $net_advance_received));


            if ($net_receive_amount >= $order_info[0]['total_amount']) {
                $this->m_common->update_row('tbl_sales_orders', array('o_id' => $order_info[0]['o_id']), array('receive_status' => "Received"));
            } else {
                $this->m_common->update_row('tbl_sales_orders', array('o_id' => $order_info[0]['o_id']), array('receive_status' => "Partial Received"));
            }

            $sql = "update tbl_customers set deposit=deposit-" . $amt . " where id=" . $order_info[0]['customer_id'];
            $this->m_common->customeUpdate($sql);

            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_complete();
            }
            echo 'success';
        } catch (UserException $error) {
            $this->db->trans_rollback();
            echo '<pre>';
            print_r($error);
            exit;
            redirect_with_msg('payment_collections/add_collection', 'Something went wrong');
        }
    }

    
   
    
    
    
    
    
    
}
