<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales_report extends Site_Controller {

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
        if(empty($this->company_id)){
             redirect_with_msg('backend/dashboard', 'Please click on enter here button to see this page');
        }
    }

    function index() {
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $this->load->view('sales_report/sales_report_list');
    }
    
   function allSalesOrder($print=false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $branch_id= $this->session->userdata('companyId');
        $data['branch_info']=$this->m_common->get_row_array('department',array('d_id'=>$branch_id),'*');
        $where='';
        $where="so.unit_id=$branch_id";
        $postData = $this->input->post();
        if(!empty($postData)){
           
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $customer_id=$this->input->post('customer_id');
           $order_id=$this->input->post('o_id');
           $product_id=$this->input->post('product_id');
           if(!empty($customer_id)){
               $data['customer_id']=$customer_id;
                if(empty($where)){
                    $where.="so.customer_id=$customer_id";
                }else{
                    $where.=" and so.customer_id=$customer_id";
                }
           }
           
           if(!empty($order_id)){
               $data['order_id']=$order_id;
                if(empty($where)){
                    $where.="so.o_id=$order_id";
                }else{
                    $where.=" and so.o_id=$order_id";
                }
           }
           
           if(!empty($product_id)){
               $data['product_id']=$product_id;
                if(empty($where)){
                    $where.="p.product_id=$product_id";
                }else{
                    $where.=" and p.product_id=$product_id";
                }
           }
           
           if(!empty($f_date) & !empty($to_date)){
                $from_date=date('Y-m-d',strtotime($f_date));
                $too_date=date('Y-m-d',strtotime($to_date));
                $data['f_date']=$f_date;
                $data['to_date']=$to_date;
           }else if(!empty($f_date)){
               $from_date=date('Y-m-d',strtotime($f_date));
               $data['f_date']=$f_date;
               $data['to_date']='';
           }else if(!empty($to_date)){
               $too_date=date('Y-m-d',strtotime($to_date));
               $data['f_date']='';
               $data['to_date']=$to_date;
           } else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           
           if(!empty($f_date) & !empty($to_date)){
               $sql="select sod.*,so.project_name,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_sales_order_details sod left join tbl_sales_orders so on  sod.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on sod.product_id=p.product_id where $where and sod.is_active=1 and so.sale_order_date>='".$from_date."' and so.sale_order_date<='".$too_date."' order by so.sale_order_date";   
               
           }else if(!empty($f_date)){
                $sql="select sod.*,so.project_name,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_sales_order_details sod left join tbl_sales_orders so on  sod.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on sod.product_id=p.product_id where $where and sod.is_active=1 and so.sale_order_date>='".$from_date."' order by so.sale_order_date";   
                
           }else if(!empty($to_date)){
               $sql="select sod.*,so.project_name,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_sales_order_details sod left join tbl_sales_orders so on  sod.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on sod.product_id=p.product_id where $where and sod.is_active=1 and so.sale_order_date<='".$too_date."' order by so.sale_order_date";   
                
           }else{
                 $sql="select sod.*,so.project_name,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_sales_order_details sod left join tbl_sales_orders so on  sod.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on sod.product_id=p.product_id where $where and sod.is_active=1 order by so.sale_order_date";   
           }
           $data['orders']=$this->m_common->customeQuery($sql);
           $data['all_orders']=$this->m_common->get_row_array('tbl_sales_orders',array('is_active'=>1),'*');
           $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
         //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
           $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
        }else{
            $data['f_date']='';
            $data['to_date']='';
            $data['order_id']='';
            $data['customer_id']='';
            $data['product_id']='';
            
            $data['all_orders']=$this->m_common->get_row_array('tbl_sales_orders',array('is_active'=>1),'*');
            $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
           // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
            $sql="select sod.*,so.project_name,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_sales_order_details sod left join tbl_sales_orders so on  sod.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on sod.product_id=p.product_id where $where and sod.is_active=1 order by so.sale_order_date";   
            $data['orders']=$this->m_common->customeQuery($sql);
        }
        
        if($print==false){
           $this->load->view('sales_report/v_all_sales_orders',$data);
        }else{
           $html=$this->load->view('sales_report/print_all_sales_orders', $data,true);
           echo $html;exit; 
        }
    }
    
   function doBalanceReport($print=false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $branch_id= $this->session->userdata('companyId');
        $data['branch_info']=$this->m_common->get_row_array('department',array('d_id'=>$branch_id),'*');
        $where='';
        $where="so.unit_id=$branch_id";
        $postData = $this->input->post();
        if(!empty($postData)){
           
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $customer_id=$this->input->post('customer_id');
           $order_id=$this->input->post('o_id');
           $product_id=$this->input->post('product_id');
           if(!empty($customer_id)){
               $data['customer_id']=$customer_id;
                if(empty($where)){
                    $where.="so.customer_id=$customer_id";
                }else{
                    $where.=" and so.customer_id=$customer_id";
                }
           }
           
           if(!empty($order_id)){
               $data['order_id']=$order_id;
                if(empty($where)){
                    $where.="so.o_id=$order_id";
                }else{
                    $where.=" and so.o_id=$order_id";
                }
           }
           
           if(!empty($product_id)){
               $data['product_id']=$product_id;
                if(empty($where)){
                    $where.="p.product_id=$product_id";
                }else{
                    $where.=" and p.product_id=$product_id";
                }
           }
           
           if(!empty($f_date) & !empty($to_date)){
                $from_date=date('Y-m-d',strtotime($f_date));
                $too_date=date('Y-m-d',strtotime($to_date));
                $data['f_date']=$f_date;
                $data['to_date']=$to_date;
           }else if(!empty($f_date)){
               $from_date=date('Y-m-d',strtotime($f_date));
               $data['f_date']=$f_date;
               $data['to_date']='';
           }else if(!empty($to_date)){
               $too_date=date('Y-m-d',strtotime($to_date));
               $data['f_date']='';
               $data['to_date']=$to_date;
           } else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           
           if(!empty($f_date) & !empty($to_date)){
               $sql="select sod.*,so.project_name,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_sales_order_details sod left join tbl_sales_orders so on  sod.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on sod.product_id=p.product_id where $where and sod.is_active=1 and so.sale_order_date>='".$from_date."' and so.sale_order_date<='".$too_date."' order by so.sale_order_date";   
               
           }else if(!empty($f_date)){
                $sql="select sod.*,so.project_name,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_sales_order_details sod left join tbl_sales_orders so on  sod.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on sod.product_id=p.product_id where $where and sod.is_active=1 and so.sale_order_date>='".$from_date."' order by so.sale_order_date";   
                
           }else if(!empty($to_date)){
               $sql="select sod.*,so.project_name,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_sales_order_details sod left join tbl_sales_orders so on  sod.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on sod.product_id=p.product_id where $where and sod.is_active=1 and so.sale_order_date<='".$too_date."' order by so.sale_order_date";   
                
           }else{
                 $sql="select sod.*,so.project_name,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_sales_order_details sod left join tbl_sales_orders so on  sod.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on sod.product_id=p.product_id where $where and sod.is_active=1 order by so.sale_order_date";   
           }
           $data['orders']=$this->m_common->customeQuery($sql);
           $data['all_orders']=$this->m_common->get_row_array('tbl_sales_orders',array('is_active'=>1),'*');
           $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
         //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
           $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
        }else{
            $data['f_date']='';
            $data['to_date']='';
            $data['order_id']='';
            $data['customer_id']='';
            $data['product_id']='';
            
            $data['all_orders']=$this->m_common->get_row_array('tbl_sales_orders',array('is_active'=>1),'*');
            $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
           // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
            $sql="select sod.*,so.project_name,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_sales_order_details sod left join tbl_sales_orders so on  sod.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on sod.product_id=p.product_id where $where and sod.is_active=1 order by so.sale_order_date";   
            $data['orders']=$this->m_common->customeQuery($sql);
            
        }
        
        if($print==false){
           $this->load->view('sales_report/v_do_balance_report',$data);
        }else{
           $html=$this->load->view('sales_report/print_all_sales_orders', $data,true);
           echo $html;exit; 
        }
    } 
    
   function allDeliveryOrder($print=false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $branch_id= $this->session->userdata('companyId');
        $data['branch_info']=$this->m_common->get_row_array('department',array('d_id'=>$branch_id),'*');
        $where='';
        $where="so.unit_id=$branch_id";
        $postData = $this->input->post();
        if(!empty($postData)){
           
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $customer_id=$this->input->post('customer_id');
           $order_id=$this->input->post('o_id');
           $product_id=$this->input->post('product_id');
           if(!empty($customer_id)){
               $data['customer_id']=$customer_id;
                if(empty($where)){
                    $where.="so.customer_id=$customer_id";
                }else{
                    $where.=" and so.customer_id=$customer_id";
                }
           }
           
            if(!empty($order_id)){
               $data['order_id']=$order_id;
                if(empty($where)){
                    $where.="so.o_id=$order_id";
                }else{
                    $where.=" and so.o_id=$order_id";
                }
           }
           
           if(!empty($product_id)){
               $data['product_id']=$product_id;
                if(empty($where)){
                    $where.="p.product_id=$product_id";
                }else{
                    $where.=" and p.product_id=$product_id";
                }
           }
           
           if(!empty($f_date) & !empty($to_date)){
                $from_date=date('Y-m-d',strtotime($f_date));
                $too_date=date('Y-m-d',strtotime($to_date));
                $data['f_date']=$f_date;
                $data['to_date']=$to_date;
           }else if(!empty($f_date)){
               $from_date=date('Y-m-d',strtotime($f_date));
               $data['f_date']=$f_date;
               $data['to_date']='';
           }else if(!empty($to_date)){
               $too_date=date('Y-m-d',strtotime($to_date));
               $data['f_date']='';
               $data['to_date']=$to_date;
           } else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           
           if(!empty($f_date) & !empty($to_date)){
              
                $sql="select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id where $where and dod.is_active=1 and do.delivery_order_date>='".$from_date."' and do.delivery_order_date<='".$too_date."' order by do.delivery_order_date";    
               
           }else if(!empty($f_date)){
              
                $sql="select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id where $where and dod.is_active=1 and do.delivery_order_date>='".$from_date."' order by do.delivery_order_date"; 
                
           }else if(!empty($to_date)){
               
               // $sql="select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id where $where and dod.is_active=1 and do.delivery_order_date<='".$too_date."'";  
               $sql="select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id where $where and dod.is_active=1 and do.delivery_order_date<='".$too_date."' order by do.delivery_order_date";  
                
           }else{
                
               // $sql="select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id where $where and dod.is_active=1";   
               $sql="select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id  left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id where $where and dod.is_active=1 order by do.delivery_order_date";   
           }
           $data['orders']=$this->m_common->customeQuery($sql);
           $data['all_orders']=$this->m_common->get_row_array('tbl_sales_orders',array('is_active'=>1),'*');
           $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
          // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
           $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
        }else{
            $data['f_date']='';
            $data['to_date']='';
            $data['order_id']='';
            $data['customer_id']='';
            $data['product_id']='';
            
            $data['all_orders']=$this->m_common->get_row_array('tbl_sales_orders',array('is_active'=>1),'*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
           // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        //    $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
            $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
            $sql="select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id where $where and dod.is_active=1 order by do.delivery_order_date";   
            $data['orders']=$this->m_common->customeQuery($sql);
        }
        
        if($print==false){
           $this->load->view('sales_report/v_all_delivery_orders',$data);
        }else{
           $html=$this->load->view('sales_report/print_all_delivery_orders', $data,true);
           echo $html;exit; 
        }
    }
 
   function allDeliveryChallan($print=false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $branch_id= $this->session->userdata('companyId');
        $data['branch_info']=$this->m_common->get_row_array('department',array('d_id'=>$branch_id),'*');
        $where='';
        $where="so.unit_id=$branch_id";
        $postData = $this->input->post();
        if(!empty($postData)){
           
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $customer_id=$this->input->post('customer_id');
           $order_id=$this->input->post('o_id');
           $product_id=$this->input->post('product_id');
           if(!empty($customer_id)){
               $data['customer_id']=$customer_id;
                if(empty($where)){
                    $where.="so.customer_id=$customer_id";
                }else{
                    $where.=" and so.customer_id=$customer_id";
                }
           }
           
           if(!empty($order_id)){
               $data['order_id']=$order_id;
                if(empty($where)){
                    $where.="do.o_id=$order_id";
                }else{
                    $where.=" and do.o_id=$order_id";
                }
           }
           
           if(!empty($product_id)){
               $data['product_id']=$product_id;
                if(empty($where)){
                    $where.="p.product_id=$product_id";
                }else{
                    $where.=" and p.product_id=$product_id";
                }
           }
           
           if(!empty($f_date) & !empty($to_date)){
                $from_date=date('Y-m-d',strtotime($f_date));
                $too_date=date('Y-m-d',strtotime($to_date));
                $data['f_date']=$f_date;
                $data['to_date']=$to_date;
           }else if(!empty($f_date)){
               $from_date=date('Y-m-d',strtotime($f_date));
               $data['f_date']=$f_date;
               $data['to_date']='';
           }else if(!empty($to_date)){
               $too_date=date('Y-m-d',strtotime($to_date));
               $data['f_date']='';
               $data['to_date']=$to_date;
           } else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           
           if(!empty($f_date) & !empty($to_date)){  
               $sql="select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id where $where and dcd.is_active=1 and dc.delivery_challan_date>='".$from_date."' and dc.delivery_challan_date<='".$too_date."' order by dc.delivery_challan_date";
           }else if(!empty($f_date)){ 
               $sql="select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id where $where and dcd.is_active=1 and dc.delivery_challan_date>='".$from_date."' order by dc.delivery_challan_date";             
           }else if(!empty($to_date)){   
               $sql="select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id where $where and dcd.is_active=1 and dc.delivery_challan_date<='".$too_date."' order by dc.delivery_challan_date";         
           }else{ 
                $sql="select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id where $where and dcd.is_active=1 order by dc.delivery_challan_date";  
           }
           $data['challans']=$this->m_common->customeQuery($sql);
           $data['all_orders']=$this->m_common->get_row_array('tbl_sales_orders',array('is_active'=>1),'*');
           $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
          // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
           $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
        }else{
            $data['f_date']='';
            $data['to_date']='';
            $data['order_id']='';
            $data['customer_id']='';
            $data['product_id']='';
            
            $data['all_orders']=$this->m_common->get_row_array('tbl_sales_orders',array('is_active'=>1),'*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
          //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
            $sql="select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id where $where and dcd.is_active=1 order by dc.delivery_challan_date";   
            $data['challans']=$this->m_common->customeQuery($sql);
        }
        
        if($print==false){
           $this->load->view('sales_report/v_all_delivery_challan',$data);
        }else{
           $html=$this->load->view('sales_report/print_all_delivery_challan', $data,true);
           echo $html;exit; 
        }
    }  
   function salesOrderNotExecuted($print=false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $branch_id= $this->session->userdata('companyId');
        $where='';
        $where="so.unit_id=$branch_id";
        $postData = $this->input->post();
        if(!empty($postData)){
           
          
           $customer_id=$this->input->post('customer_id');
           if(!empty($customer_id)){
                if(empty($where)){
                    $where.="sq.customer_id=$customer_id";
                }else{
                    $where.=" and sq.customer_id=$customer_id";
                }
           }
           if(!empty($f_date) & !empty($to_date)){
                $from_date=date('Y-m-d',strtotime($f_date));
                $too_date=date('Y-m-d',strtotime($to_date));
                $data['f_date']=$f_date;
                $data['to_date']=$to_date;
           }else if(!empty($f_date)){
               $from_date=date('Y-m-d',strtotime($f_date));
               $data['f_date']=$f_date;
               $data['to_date']='';
           }else if(!empty($to_date)){
               $too_date=date('Y-m-d',strtotime($to_date));
               $data['f_date']='';
               $data['to_date']=$to_date;
           } else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           
           if(!empty($f_date) & !empty($to_date)){
                $sql="select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where ".$where." and so.is_active=1 and so.status='Pending' and sale_order_date>='".$from_date."' and sale_order_date<='".$too_date;
           }else if(!empty($f_date)){
                $sql="select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where ".$where." and so.is_active=1 and so.status='Pending' and sale_order_date>='".$from_date;
           }else if(!empty($to_date)){
                $sql="select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where ".$where." and so.is_active=1 and so.status='Pending' and sale_order_date<='".$too_date;
           }else{
                $sql="select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where ".$where." and so.is_active=1 and so.status='Pending' ";
           }
           $data['orders']=$this->m_common->customeQuery($sql);
          // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
           $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
        }else{
            $data['f_date']='';
            $data['to_date']='';
          //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
            $sql="select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where $where and so.is_active=1 and so.status='Pending' ";
            $data['orders']=$this->m_common->customeQuery($sql);
        }
        
        if($print==false){
             $this->load->view('sales_report/v_not_executed_sales_orders',$data);
        }else{
           $html=$this->load->view('sales_report/print_not_executed_sales_orders', $data,true);
           echo $html;exit; 
        }
    }
    
   function receivableSalesOrdersBeforeDelivery($print=false) {
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $sql="select so.*,c.c_name,c_short_name,pc.b_cash_amount,pc.b_bg_amount,pc.b_pdc_amount,pc.b_lc_amount from tbl_sales_orders so left join tbl_sales_order_payment_condition pc on so.o_id=pc.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where so.is_active=1 and (so.receive_status='Pending' or so.receive_status='Partial Received') ";
        $data['orders']=$this->m_common->customeQuery($sql);   
        foreach($data['orders'] as $key=>$order){
            $b_total_amount=$order['b_cash_amount']+$order['b_bg_amount']+$order['b_pdc_amount']+$order['b_lc_amount'];
            if($b_total_amount>0){
                $c_sql="select sum(amount) as total_amount from tbl_payment_collections where payment_status='Received' and o_id=".$order['o_id'];
                $total=$this->m_common->customeQuery($c_sql);
                if(!empty($total)){
                    if($total[0]['total_amount']<$b_total_amount){
                        $data['orders'][$key]['receivable_amount']=$b_total_amount-$total[0]['total_amount'];
                    }else{
                        unset($data['orders'][$key]);
                    }

                }else{
                    $data['orders'][$key]['receivable_amount']=$b_total_amount;

                }
            }else{
                unset($data['orders'][$key]);
            }
        }
        if($print==false){
           $this->load->view('sales_report/v_receivable_before_delivery',$data);
        }else{
           $html=$this->load->view('sales_report/print_receivable_before_delivery', $data,true);
           echo $html;exit; 
        }
    }
    
   function receivableSalesOrders($print=false) {
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $sql="select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where so.is_active=1 and (so.receive_status='Pending' or so.receive_status='Partial Received') ";
        $data['orders']=$this->m_common->customeQuery($sql);   
        foreach($data['orders'] as $key=>$order){
            $c_sql="select sum(amount) as total_amount from tbl_payment_collections where payment_status='Received' and o_id=".$order['o_id'];
            $total=$this->m_common->customeQuery($c_sql);
            if(!empty($total)){
                $data['orders'][$key]['received_amount']=$total[0]['total_amount'];
                $data['orders'][$key]['due_amount']=$order['total_amount']-$total[0]['total_amount'];
            }else{
                $data['orders'][$key]['received_amount']='';
                $data['orders'][$key]['due_amount']=$order['total_amount'];
            }
        }
        if($print==false){
           $this->load->view('sales_report/v_receivable_orders',$data);
        }else{
           $html=$this->load->view('sales_report/print_receivable_orders', $data,true);
           echo $html;exit; 
        }
    }
    
   function handsToRealized($print=false){
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $sql="select pc.*,so.order_no,so.project_name,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name from tbl_payment_collections pc left join  tbl_sales_orders so on pc.o_id=so.o_id left join tbl_banks b on pc.bank_id=b.id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where pc.is_active=1 and pc.payment_status='Pending' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') ";
        $data['orders']=$this->m_common->customeQuery($sql);
        
        if($print==false){
           $this->load->view('sales_report/v_have_to_realized',$data);
        }else{
           $html=$this->load->view('sales_report/print_have_to_realized', $data,true);
           echo $html;exit; 
        }
    }
    
   function deliveredOrdersWithoutPayment($print=false){
        $this->menu = 'sales';
        $this->sub_inner_menu ='sales_report';
        $this->titlebackend("Report");
        $sql="select do.*,c.c_name,c_short_name,so.order_no,so.sale_order_date from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where do.is_active=1 and (do.status='Delivered' or do.status='Partially Delivered') and so.receive_status='Pending' ";
        $data['orders']=$this->m_common->customeQuery($sql);
        if($print==false){
           $this->load->view('sales_report/v_d_orders_without_payment',$data);
        }else{
           $html=$this->load->view('sales_report/print_d_orders_without_payment', $data,true);
           echo $html;exit; 
        }
    }
    

}
