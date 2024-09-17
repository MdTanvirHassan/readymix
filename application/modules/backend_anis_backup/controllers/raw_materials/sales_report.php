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
        if (empty($this->company_id)) {
            redirect_with_msg('backend/dashboard', 'Please click on enter here button to see this page');
        }
    }

    function index() {
        $this->menu='trading';
        $this->sub_menu='report';
        $this->sub_inner_menu='report';
        $this->titlebackend("Report");
        $this->load->view('raw_materials/sales_report/sales_report_list');
    }

    
    
    function lcBalanceReport($print=false){
        $this->menu='trading';
        $this->sub_menu='report';
        $this->sub_inner_menu='report';
        $this->titlebackend("Report");
        
        
        $lc_id=$this->input->post('lc_id');
        $data['lc_id']=$lc_id;
        
        $lc_sql="select rlr.*,il.lc_no from rm_lc_receive rlr left join import_lc il on rlr.lc_id=il.lc_id";
        $data['lcs']=$this->m_common->customeQuery($lc_sql);
        if(!empty($lc_id)){
            $lc_d_sql="select lrd.*,lr.mother_vessel_name,il.lc_no,il.date,ri.item_name,tmu.meas_unit from rm_lc_receive_details lrd left join rm_lc_receive lr on lrd.mrr_id=lr.mrr_id left join import_lc_details ild on lrd.lc_details_id=ild.id left join import_lc il on ild.lc_id=il.lc_id left join rm_items ri on lrd.item_id=ri.id left join tbl_measurement_unit tmu on ri.mu_id=tmu.id where il.lc_id=".$lc_id;
        }else{
            $lc_d_sql="select lrd.*,lr.mother_vessel_name,il.lc_no,il.date,ri.item_name,tmu.meas_unit from rm_lc_receive_details lrd left join rm_lc_receive lr on lrd.mrr_id=lr.mrr_id left join import_lc_details ild on lrd.lc_details_id=ild.id left join import_lc il on ild.lc_id=il.lc_id left join rm_items ri on lrd.item_id=ri.id left join tbl_measurement_unit tmu on ri.mu_id=tmu.id";
        }
        $data['lc_details']=$this->m_common->customeQuery($lc_d_sql);
        foreach($data['lc_details'] as $key=>$value){
            $do_details=array();
            $yard_challan_details=array();
            $hook_challan_details=array();
            
            $d_sql="select sum(quantity) as total_challan_qty from rm_delivery_challan_details where s_item_id=".$value['item_id']." and lc_details_id=".$value['lc_details_id'];
            $do_details=$this->m_common->customeQuery($d_sql);
            
            
            $y_sql="select sum(rdcd.quantity) as total_challan_qty from rm_delivery_challan_details rdcd left join rm_delivery_challans rdc on rdcd.dc_id=rdc.dc_id  where rdc.delivery_location='Yard' and rdcd.s_item_id=".$value['item_id']." and rdcd.lc_details_id=".$value['lc_details_id'];
            $yard_challan_details=$this->m_common->customeQuery($y_sql);
            
            $h_sql="select sum(rdcd.quantity) as total_challan_qty from rm_delivery_challan_details rdcd left join rm_delivery_challans rdc on rdcd.dc_id=rdc.dc_id  where rdc.delivery_location='Hook' and rdcd.s_item_id=".$value['item_id']." and rdcd.lc_details_id=".$value['lc_details_id'];
            $hook_challan_details=$this->m_common->customeQuery($h_sql);
            
            $d_sql="select sum(quantity) as total_challan_qty from rm_delivery_challan_details where s_item_id=".$value['item_id']." and lc_details_id=".$value['lc_details_id'];
            $do_details=$this->m_common->customeQuery($d_sql);
            
            if(!empty($do_details)){
              $data['lc_details'][$key]['total_challan_qty']=$do_details[0]['total_challan_qty'];  
            }else{
              $data['lc_details'][$key]['total_challan_qty']=0;  
            }
            
            if(!empty($yard_challan_details)){
              $data['lc_details'][$key]['total_yard_challan_qty']=$yard_challan_details[0]['total_challan_qty'];  
            }else{
              $data['lc_details'][$key]['total_yard_challan_qty']=0;  
            }
            
            if(!empty($hook_challan_details)){
              $data['lc_details'][$key]['total_hook_challan_qty']=$hook_challan_details[0]['total_challan_qty'];  
            }else{
              $hook_challan_details['lc_details'][$key]['total_hook_challan_qty']=0;  
            }
            
            
        }
        
        if ($print == false) {
           $this->load->view('raw_materials/sales_report/v_lc_balance_report',$data);
        } else {
            $html = $this->load->view('raw_materials/sales_report/print_lc_balance_report', $data, true);
            echo $html;
            exit;
        }
        
        
    }
    
    function lcBalanceReportExcel(){
        $this->menu='trading';
        $this->sub_menu='report';
        $this->sub_inner_menu='report';
        $this->titlebackend("Report");
        
        
        $lc_id=$this->input->post('lc_id');
        $data['lc_id']=$lc_id;
        
        $lc_sql="select rlr.*,il.lc_no from rm_lc_receive rlr left join import_lc il on rlr.lc_id=il.lc_id";
        $data['lcs']=$this->m_common->customeQuery($lc_sql);
        if(!empty($lc_id)){
            $lc_d_sql="select lrd.*,lr.mother_vessel_name,il.lc_no,il.date,ri.item_name,tmu.meas_unit from rm_lc_receive_details lrd left join rm_lc_receive lr on lrd.mrr_id=lr.mrr_id left join import_lc_details ild on lrd.lc_details_id=ild.id left join import_lc il on ild.lc_id=il.lc_id left join rm_items ri on lrd.item_id=ri.id left join tbl_measurement_unit tmu on ri.mu_id=tmu.id where il.lc_id=".$lc_id;
        }else{
            $lc_d_sql="select lrd.*,lr.mother_vessel_name,il.lc_no,il.date,ri.item_name,tmu.meas_unit from rm_lc_receive_details lrd left join rm_lc_receive lr on lrd.mrr_id=lr.mrr_id left join import_lc_details ild on lrd.lc_details_id=ild.id left join import_lc il on ild.lc_id=il.lc_id left join rm_items ri on lrd.item_id=ri.id left join tbl_measurement_unit tmu on ri.mu_id=tmu.id";
        }
        $data['lc_details']=$this->m_common->customeQuery($lc_d_sql);
        foreach($data['lc_details'] as $key=>$value){
            $do_details=array();
            $d_sql="select sum(quantity) as total_challan_qty from rm_delivery_challan_details where s_item_id=".$value['item_id']." and lc_details_id=".$value['lc_details_id'];
            $do_details=$this->m_common->customeQuery($d_sql);
            if(!empty($do_details)){
              $data['lc_details'][$key]['total_challan_qty']=$do_details[0]['total_challan_qty'];  
            }
        }
        
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Lc Balance Report');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:Q3')->applyFromArray($style);

        $table_columns = array("SL","LC. Date","LC. No.", "Mother Vessel Name","P.Name", "M.Unit", "Receive Qty", "Challan Qty", "Remaining Qty");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:U5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:U5')->getFont()->setBold(true);


        $excel_row = 6;
        if (!empty($data['lc_details'])) {
            $total = 0;
            $total_value=0;
            $i = 0;
            foreach ($data['lc_details'] as $lc_d) {
                $i++;
                
                $total_lr=$total_lr+$lc_d['survey_qty'];
                $total_challan=$total_challan+$lc_d['total_challan_qty'];
                $total_remaining=$total_remaining+($lc_d['survey_qty']-$lc_d['total_challan_qty']);
               
               

                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y', strtotime($lc_d['date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $lc_d['lc_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $lc_d['mother_vessel_name']);
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $lc_d['item_name']);
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $lc_d['meas_unit']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $lc_d['survey_qty']);
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $lc_d['total_challan_qty']);
                $remaining_qty=$lc_d['survey_qty']-$lc_d['total_challan_qty'];
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row,$remaining_qty);
                
                

                $excel_row++;
            }
        }
        
        $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row,'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row,round($total_lr, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row,round($total_challan, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row,round($total_remaining, 2));
       

        $object->getActiveSheet()->getStyle("L$excel_row:V$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("L$excel_row:V$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:N' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('R6:N'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'N'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="report.xls"');
        $object_writer->save('php://output');
    }
    
    
    function customerLedgerReport(){
        $branch_id = $this->session->userdata('companyId');
        $postData = $this->input->post();
        $customer_id=$this->input->post('customer_id');
        if(!empty($postData)){
          if(!empty($customer_id)){  
            $data['customer_id']=$customer_id; 
          }else{
            $data['customer_id']='';  
          }
       // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
          $data['f_date'] = $from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
          $data['to_date'] = $too_date = date('Y-m-d',strtotime($this->input->post('to_date')));  
          if(!empty($customer_id)){ 
            $sql="select tsi.*,tc.c_name,tc.opening_balance from  tbl_sales_invoices as tsi left join tbl_customers tc on tsi.customer_id=tc.id  where tsi.is_active=1 and tsi.customer_id=".$customer_id." group by tsi.customer_id";
          }else{
            $sql="select tsi.*,tc.c_name,tc.opening_balance from  tbl_sales_invoices as tsi left join tbl_customers tc on tsi.customer_id=tc.id  where tsi.is_active=1 group by tsi.customer_id";  
          }
          $data['customers']= $this->m_common->customeQuery($sql);
        
        }else{
            $sql="select tsi.*,tc.c_name,tc.opening_balance from  tbl_sales_invoices as tsi left join tbl_customers tc on tsi.customer_id=tc.id  where tsi.is_active=1 group by tsi.customer_id";
            $data['customers']= $this->m_common->customeQuery($sql);
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $data['customer_id']='';
        }
        
        $sql="select tsi.*,tc.c_name from  tbl_sales_invoices as tsi left join tbl_customers tc on tsi.customer_id=tc.id  where tsi.is_active=1 group by tsi.customer_id order by tc.c_name asc";
        $data['all_customers']= $this->m_common->customeQuery($sql);
        $this->load->view('sales_report/v_customer_ledger_report',$data);
    }
    
    

    
    function delivery_order_info() {
        $this->setOutputMode(NORMAL);
        $customer_id = $this->input->post('customer_id');
        $data['order_info'] = $this->m_common->get_row_array('rm_delivery_orders', array('customer_id' =>$customer_id,'is_active' => 1),'*');
        echo json_encode($data);
    }
    
    function doBalanceReport($print = false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        //$where = "do.branch_id=$branch_id";
        $where = "dod.is_active=1";
        $postData = $this->input->post();
        if (!empty($postData)) {

            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            
            $order_id = $this->input->post('do_id');
            

            if(!empty($customer_id)){
                $data['all_orders'] = $this->m_common->get_row_array('rm_delivery_orders', array('customer_id' =>$customer_id,'is_active' => 1),'*');
            }else{
                $data['all_orders'] = $this->m_common->get_row_array('rm_delivery_orders', array('is_active' => 1),'*');
            } 


            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .=" do.customer_id=$customer_id";
                } else {
                    $where .= " and do.customer_id=$customer_id";
                }
                
            } 



            



            if (!empty($order_id)) {
                $data['do_id'] = $order_id;
                if (empty($where)) {
                    $where .= "do.do_id=$order_id";
                } else {
                    $where .= " and do.do_id=$order_id";
                }
            }

            
            
            

            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = '';
                $data['to_date'] = '';
            }


            if (!empty($f_date) & !empty($to_date)) {
                $sql="select dod.*,(select sum(quantity) as total_c_qty from rm_delivery_challan_details where do_details_id=dod.do_details_id) as total_challan_qty,do.delivery_no,do.delivery_order_date,tc.c_name,ri.item_name,tmu.meas_unit from rm_delivery_orders_details dod 
                  left join rm_delivery_orders do on dod.do_id=do.do_id
                  left join tbl_customers tc on do.customer_id=tc.id
                  left join rm_items ri on dod.s_item_id=ri.id
                  left join tbl_measurement_unit tmu on ri.mu_id=tmu.id
                  where $where and do.delivery_order_date>='" . $from_date . "' and do.delivery_order_date<='" . $too_date . "' order by do.delivery_order_date DESC ";
            }else{
                $sql="select dod.*,(select sum(quantity) as total_c_qty from rm_delivery_challan_details where do_details_id=dod.do_details_id) as total_challan_qty,do.delivery_no,do.delivery_order_date,tc.c_name,ri.item_name,tmu.meas_unit from rm_delivery_orders_details dod 
                  left join rm_delivery_orders do on dod.do_id=do.do_id
                  left join tbl_customers tc on do.customer_id=tc.id
                  left join rm_items ri on dod.s_item_id=ri.id
                  left join tbl_measurement_unit tmu on ri.mu_id=tmu.id
                  where $where order by do.delivery_order_date DESC ";
            }
            $data['orders'] = $this->m_common->customeQuery($sql);
            
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1,'customer_category'=>'Raw Material'), '*', '', '', 'c_name');

            
        } else {
            $from_date = date('Y-m-01');
            $too_date = date('Y-m-t');
            $data['f_date'] = date('01-m-Y');
            $data['to_date'] = date('t-m-Y');
            $data['do_id'] = '';
            $data['customer_id'] = '';
            
            
            
            $data['all_orders'] = $this->m_common->get_row_array('rm_delivery_orders', array('is_active' => 1), '*');
           
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1,'customer_category'=>'Raw Material'), '*', '', '', 'c_name');
            
            $sql="select dod.*,(select sum(quantity) as total_c_qty from rm_delivery_challan_details where do_details_id=dod.do_details_id) as total_challan_qty,do.delivery_no,do.delivery_order_date,tc.c_name,ri.item_name,tmu.meas_unit from rm_delivery_orders_details dod 
                  left join rm_delivery_orders do on dod.do_id=do.do_id
                  left join tbl_customers tc on do.customer_id=tc.id
                  left join rm_items ri on dod.s_item_id=ri.id
                  left join tbl_measurement_unit tmu on ri.mu_id=tmu.id
                  where $where and do.delivery_order_date>='" . $from_date . "' and do.delivery_order_date<='" . $too_date . "' order by do.delivery_order_date DESC ";
            $data['orders'] = $this->m_common->customeQuery($sql);
           
        }
        
         if ($print == false) {
            $this->load->view('raw_materials/sales_report/v_do_balance_report', $data);
        } else {
            $html = $this->load->view('raw_materials/sales_report/print_do_balance_report', $data, true);
            echo $html;
            exit;
        }
    }

    function doBalanceReportExcel() {
        $this->load->library("PHPExcel");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        $where = "do.branch_id=$branch_id";
        $postData = $this->input->post();
        if (!empty($postData)) {

            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            
            $order_id = $this->input->post('do_id');
            

            if(!empty($customer_id)){
                $data['all_orders'] = $this->m_common->get_row_array('rm_delivery_orders', array('customer_id' =>$customer_id,'is_active' => 1),'*');
            }else{
                $data['all_orders'] = $this->m_common->get_row_array('rm_delivery_orders', array('is_active' => 1),'*');
            } 


            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .=" do.customer_id=$customer_id";
                } else {
                    $where .= " and do.customer_id=$customer_id";
                }
                
            } 



            



            if (!empty($order_id)) {
                $data['do_id'] = $order_id;
                if (empty($where)) {
                    $where .= "do.do_id=$order_id";
                } else {
                    $where .= " and do.do_id=$order_id";
                }
            }

            
            
            

            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = '';
                $data['to_date'] = '';
            }


            if (!empty($f_date) & !empty($to_date)) {
                $sql="select dod.*,do.delivery_no,do.delivery_order_date,tc.c_name,ri.item_name,tmu.meas_unit from rm_delivery_orders_details dod 
                  left join rm_delivery_orders do on dod.do_id=do.do_id
                  left join tbl_customers tc on do.customer_id=tc.id
                  left join rm_items ri on dod.s_item_id=ri.id
                  left join tbl_measurement_unit tmu on ri.mu_id=tmu.id
                  where $where and do.delivery_order_date>='" . $from_date . "' and do.delivery_order_date<='" . $too_date . "' order by do.delivery_order_date DESC ";
            }else{
                $sql="select dod.*,do.delivery_no,do.delivery_order_date,tc.c_name,ri.item_name,tmu.meas_unit from rm_delivery_orders_details dod 
                  left join rm_delivery_orders do on dod.do_id=do.do_id
                  left join tbl_customers tc on do.customer_id=tc.id
                  left join rm_items ri on dod.s_item_id=ri.id
                  left join tbl_measurement_unit tmu on ri.mu_id=tmu.id
                  where $where order by do.delivery_order_date DESC ";
            }
            $data['orders'] = $this->m_common->customeQuery($sql);
            
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1,'customer_category'=>'Raw Material'), '*', '', '', 'c_name');

            
        } else {
            $from_date = date('Y-m-01');
            $too_date = date('Y-m-t');
            $data['f_date'] = date('01-m-Y');
            $data['to_date'] = date('t-m-Y');
            $data['do_id'] = '';
            $data['customer_id'] = '';
            
            
            
            $data['all_orders'] = $this->m_common->get_row_array('rm_delivery_orders', array('is_active' => 1), '*');
           
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1,'customer_category'=>'Raw Material'), '*', '', '', 'c_name');
            
            $sql="select dod.*,do.delivery_no,do.delivery_order_date,tc.c_name,ri.item_name,tmu.meas_unit from rm_delivery_orders_details dod 
                  left join rm_delivery_orders do on dod.do_id=do.do_id
                  left join tbl_customers tc on do.customer_id=tc.id
                  left join rm_items ri on dod.s_item_id=ri.id
                  left join tbl_measurement_unit tmu on ri.mu_id=tmu.id
                  where $where and do.delivery_order_date>='" . $from_date . "' and do.delivery_order_date<='" . $too_date . "' order by do.delivery_order_date DESC ";
            $data['orders'] = $this->m_common->customeQuery($sql);
           
        }

        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Delivery Order Balance');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:N3')->applyFromArray($style);

        $table_columns = array("SL", "D. Order Date.", "D. Order No.", "Customer Name","Product Name","M. Unit","Do. Qty","Challan Qty","Challan Due Qty");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setBold(true);


        $excel_row = 6;


        if (!empty($data['orders'])) {
            $total_so_qty = 0;
            $total_do_qty = 0;
            $total_do_due_qty = 0;
            $total_chal_qty = 0;
            $total_chall_due_qty = 0;
            $i = 0;
            foreach ($data['orders'] as $order) {
                $i++;
                
                    
                $total_do_qty=$total_do_qty+$order['quantity'];
                $total_chal_qty=$total_chal_qty+$order['delivery_quantity'];
                $total_chall_due_qty=$total_chall_due_qty+($order['quantity']-$order['delivery_quantity']);
                
               
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y', strtotime($order['delivery_order_date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $order['delivery_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $order['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $order['item_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $order['meas_unit']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, round($order['quantity'], 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, round($order['delivery_quantity'], 2));
                

                $due_c = round(($order['quantity']-$order['delivery_quantity']),2);
              
                $object->getActiveSheet()->setCellValueByColumnAndRow(13,$excel_row,$due_c);
                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row,'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row,round($total_do_qty, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row,round($total_chal_qty, 2));

        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row,round($total_chall_due_qty, 2));
        

        $object->getActiveSheet()->getStyle("L$excel_row:P$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("L$excel_row:P$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:N' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('M6:N'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'N'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="report.xls"');
        $object_writer->save('php://output');
    }

    function allDeliveryOrder($print = false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        $where = "so.unit_id=$branch_id";
        $postData = $this->input->post();
        if (!empty($postData)) {

            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $category_id = $this->input->post('category_id');
//           if(!empty($customer_id)){
//               $data['customer_id']=$customer_id;
//                if(empty($where)){
//                    $where.="so.customer_id=$customer_id";
//                }else{
//                    $where.=" and so.customer_id=$customer_id";
//                }
//           }


            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "so.customer_id=$customer_id";
                } else {
                    $where .= " and so.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }



            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    $where .= "so.project_id=$project_id";
                } else {
                    $where .= " and so.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }

            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "so.o_id=$order_id";
                } else {
                    $where .= " and so.o_id=$order_id";
                }
            }

            if (!empty($product_id)) {
                $data['product_id'] = $product_id;
                if (empty($where)) {
                    $where .= "p.product_id=$product_id";
                } else {
                    $where .= " and p.product_id=$product_id";
                }
            }
            
            if(!empty($category_id)){
                $data['category_id']=$category_id;
                if(empty($where)){
                    $where .= "tpc.category_id=$category_id";
                }else{
                    $where .= " and tpc.category_id=$category_id";
                }
            }
            

            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = '';
                $data['to_date'] = '';
            }


            if (!empty($f_date) & !empty($to_date)) {

                $sql = "select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id where $where and do.do_status='Approved' and dod.is_active=1 and do.delivery_order_date>='" . $from_date . "' and do.delivery_order_date<='" . $too_date . "' order by do.delivery_order_date DESC";
            } else if (!empty($f_date)) {

                $sql = "select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id where $where and dod.is_active=1 and do.do_status='Approved' and do.delivery_order_date>='" . $from_date . "' order by do.delivery_order_date DESC";
            } else if (!empty($to_date)) {

                // $sql="select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id where $where and dod.is_active=1 and do.delivery_order_date<='".$too_date."'";  
                $sql = "select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id where $where and dod.is_active=1 and do.do_status='Approved' and do.delivery_order_date<='" . $too_date . "' order by do.delivery_order_date DESC";
            } else {

                // $sql="select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id where $where and dod.is_active=1";   
                $sql = "select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id  left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id where $where and dod.is_active=1 and do.do_status='Approved' order by do.delivery_order_date DESC";
            }
            $data['orders'] = $this->m_common->customeQuery($sql);
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = '';
            $data['to_date'] = '';
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';
            $data['category_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            //    $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            $sql = "select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id where $where and dod.is_active=1 and do.do_status='Approved' order by do.delivery_order_date DESC";
            $data['orders'] = $this->m_common->customeQuery($sql);
        }

        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*');
        
        if ($print == false) {
            $this->load->view('sales_report/v_all_delivery_orders', $data);
        } else {
            $html = $this->load->view('sales_report/print_all_delivery_orders', $data, true);
            echo $html;
            exit;
        }
    }

    function allDeliveryOrderExcel($print = false) {
        $this->load->library("PHPExcel");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        $where = "so.unit_id=$branch_id";
        $postData = $this->input->post();
        if (!empty($postData)) {

            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $category_id = $this->input->post('category_id');
//           if(!empty($customer_id)){
//               $data['customer_id']=$customer_id;
//                if(empty($where)){
//                    $where.="so.customer_id=$customer_id";
//                }else{
//                    $where.=" and so.customer_id=$customer_id";
//                }
//           }


            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "so.customer_id=$customer_id";
                } else {
                    $where .= " and so.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }



            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    $where .= "so.project_id=$project_id";
                } else {
                    $where .= " and so.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }

            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "so.o_id=$order_id";
                } else {
                    $where .= " and so.o_id=$order_id";
                }
            }

            if (!empty($product_id)) {
                $data['product_id'] = $product_id;
                if (empty($where)) {
                    $where .= "p.product_id=$product_id";
                } else {
                    $where .= " and p.product_id=$product_id";
                }
            }
            
            if(!empty($category_id)){
                $data['category_id']=$category_id;
                if(empty($where)){
                    $where .= "tpc.category_id=$category_id";
                }else{
                    $where .= " and tpc.category_id=$category_id";
                }
            }
            

            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = '';
                $data['to_date'] = '';
            }


            if (!empty($f_date) & !empty($to_date)) {

                $sql = "select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id where $where and do.do_status='Approved' and dod.is_active=1 and do.delivery_order_date>='" . $from_date . "' and do.delivery_order_date<='" . $too_date . "' order by do.delivery_order_date DESC";
            } else if (!empty($f_date)) {

                $sql = "select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id where $where and dod.is_active=1 and do.do_status='Approved' and do.delivery_order_date>='" . $from_date . "' order by do.delivery_order_date DESC";
            } else if (!empty($to_date)) {

                // $sql="select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id where $where and dod.is_active=1 and do.delivery_order_date<='".$too_date."'";  
                $sql = "select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id where $where and dod.is_active=1 and do.do_status='Approved' and do.delivery_order_date<='" . $too_date . "' order by do.delivery_order_date DESC";
            } else {

                // $sql="select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id where $where and dod.is_active=1";   
                $sql = "select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id  left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id where $where and dod.is_active=1 and do.do_status='Approved' order by do.delivery_order_date DESC";
            }
            $data['orders'] = $this->m_common->customeQuery($sql);
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = '';
            $data['to_date'] = '';
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';
            $data['category_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            //    $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*','','','c_name');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            $sql = "select dod.*,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name from tbl_delivery_order_details dod left join tbl_delivery_orders do on  dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dod.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id where $where and dod.is_active=1 and do.do_status='Approved' order by do.delivery_order_date DESC";
            $data['orders'] = $this->m_common->customeQuery($sql);
        }

        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Delivery Orders');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:P3')->applyFromArray($style);

        $table_columns = array("SL", "Delivary Date.", "Delivery No.", "S.Order No.", "Customer Name", "Project","Product Type", "Product Name", "M. Unit", "Quantity");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:O5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:O5')->getFont()->setBold(true);


        $excel_row = 6;


        if(!empty($data['orders'])){
            $total_so_qty = 0;
            $total_do_qty = 0;
            $total_do_due_qty = 0;
            $total_chal_qty = 0;
            $total_chall_due_qty = 0;
            $i = 0;
            foreach ($data['orders'] as $order) {
                $i++;
                if ($order['product_name'] != 'Grouting') {
                    $total = $total + $order['quantity'];
                }
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y', strtotime($order['delivery_order_date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $order['delivery_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $order['order_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $order['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $order['project_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $order['category_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $order['product_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $order['measurement_unit']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, round($order['quantity'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row,'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row,round($total, 2));

        $object->getActiveSheet()->getStyle("L$excel_row:O$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("L$excel_row:O$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:O' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('M6:M'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'O'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="report.xls"');
        $object_writer->save('php://output');
    }

    function allDeliveryChallan($print = false) {
        $this->menu = 'trading';
        $this->sub_menu = 'report';
        $this->sub_inner_menu = 'report';
        $this->titlebackend("Report");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        $where = "dc.is_active=1";
        $postData = $this->input->post();
        if (!empty($postData)) {

            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            
            $order_id = $this->input->post('do_id');
           
            $bill_status=$this->input->post('bill_status');
            $delivery_location=$this->input->post('delivery_location');
            $item_id = $this->input->post('item_id');
            $lc_id = $this->input->post('lc_id');

            if(!empty($customer_id)){
                $data['all_orders'] = $this->m_common->get_row_array('rm_delivery_orders', array('is_active' =>1,'customer_id'=>$customer_id), '*');
            }else{
                $data['all_orders'] = $this->m_common->get_row_array('rm_delivery_orders', array('is_active' => 1), '*');
            }
            
            
            if (!empty($item_id)) {
                $data['item_id'] = $item_id;
                if (empty($where)) {
                    $where .= "dcd.s_item_id=$item_id";
                } else {
                    $where .= " and dcd.s_item_id=$item_id";
                }
            }else{
               $data['item_id'] =''; 
            }
            
            
            if(!empty($lc_id)){
                $lc_in_sql="select rlr.*,il.lc_no from rm_lc_receive rlr left join import_lc il on rlr.lc_id=il.lc_id";
                $data['lc_info']=$this->m_common->customeQuery($lc_in_sql);
                $data['lc_id'] = $lc_id;
                if(empty($where)){
                    $where .= "lcd.lc_id=$lc_id";
                }else{
                    $where .= " and lcd.lc_id=$lc_id";
                }
            }else{
               $data['lc_id'] =''; 
               $data['lc_info'] ='';
            }
            
            
            if (!empty($order_id)) {
                $data['do_id'] = $order_id;
                if (empty($where)) {
                    $where .= "do.do_id=$order_id";
                } else {
                    $where .= " and do.do_id=$order_id";
                }
            }

            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "do.customer_id=$customer_id";
                } else {
                    $where .= " and do.customer_id=$customer_id";
                }
                
            } 

            if (!empty($delivery_location)) {
                $data['delivery_location']=$delivery_location;
                if (empty($where)) {
                    $where .= "dc.delivery_location='$delivery_location'";
                } else {
                    $where .= " and dc.delivery_location='$delivery_location'";
                }
            }else{
                $data['delivery_location']='';
            }
            
            
            
            if (!empty($bill_status)) {
                $data['bill_status'] = $bill_status;
                if (empty($where)) {
                    $where .= "dcd.bill_status='$bill_status'";
                } else {
                    $where .= " and dcd.bill_status='$bill_status'";
                }
            }else{
                $data['bill_status'] ='';
            }
            
            
            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            }


            if(!empty($f_date) & !empty($to_date)){
               // $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,do.delivery_no,do.delivery_order_date,c.c_name,p.item_name,dc.driver_name,dc.truck_no,tmu.meas_unit from rm_delivery_challan_details dcd left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id left join rm_delivery_orders do on dod.do_id=do.do_id left join tbl_customers c on do.customer_id=c.id left join rm_items p on dcd.s_item_id=p.id left join tbl_measurement_unit tmu on p.mu_id=tmu.id left join import_lc_details lcd on dcd.lc_details_id=lcd.id where $where and dc.status='Approved' and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.delivery_challan_date desc";
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,do.delivery_no,do.delivery_order_date,c.c_name,p.item_name,dc.driver_name,dc.truck_no,tmu.meas_unit,rlcr.mother_vessel_name
                        from rm_delivery_challan_details dcd
                        left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id 
                        left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id 
                        left join rm_delivery_orders do on dod.do_id=do.do_id 
                        left join tbl_customers c on do.customer_id=c.id 
                        left join rm_items p on dcd.s_item_id=p.id 
                        left join tbl_measurement_unit tmu on p.mu_id=tmu.id 
                        left join import_lc_details lcd on dcd.lc_details_id=lcd.id 
                        left join import_lc lc on lcd.lc_id=lc.lc_id
                        left join rm_lc_receive rlcr on lc.lc_id=rlcr.lc_id
                        where $where and dc.status='Approved' and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.delivery_challan_date desc";
            }else{
              //  $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,do.delivery_no,do.delivery_order_date,c.c_name,p.item_name,dc.driver_name,dc.truck_no,tmu.meas_unit from rm_delivery_challan_details dcd left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id left join rm_delivery_orders do on dod.do_id=do.do_id left join tbl_customers c on do.customer_id=c.id left join rm_items p on dcd.s_item_id=p.id left join tbl_measurement_unit tmu on p.mu_id=tmu.id left join import_lc_details lcd on dcd.lc_details_id=lcd.id where $where and dc.status='Approved' order by dc.delivery_challan_date desc";
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,do.delivery_no,do.delivery_order_date,c.c_name,p.item_name,dc.driver_name,dc.truck_no,tmu.meas_unit,rlcr.mother_vessel_name
                        from rm_delivery_challan_details dcd 
                        left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id 
                        left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id 
                        left join rm_delivery_orders do on dod.do_id=do.do_id 
                        left join tbl_customers c on do.customer_id=c.id 
                        left join rm_items p on dcd.s_item_id=p.id 
                        left join tbl_measurement_unit tmu on p.mu_id=tmu.id 
                        left join import_lc_details lcd on dcd.lc_details_id=lcd.id 
                        left join import_lc lc on lcd.lc_id=lc.lc_id
                        left join rm_lc_receive rlcr on lc.lc_id=rlcr.lc_id
                        where $where and dc.status='Approved' order by dc.delivery_challan_date desc";
            }
            $data['challans'] = $this->m_common->customeQuery($sql);
            
            
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1,'customer_category'=>'Raw Material'), '*', '', '', 'c_name');
        }else{
        //    $data['f_date'] = $from_date = date('Y-m-01');
        //    $data['to_date'] = $too_date = date('Y-m-t');
            $data['delivery_location']='';
            
            $data['f_date'] = $from_date = date('Y-m-d');
            $data['to_date'] = $too_date = date('Y-m-d');
            
            $f_date = date('d-m-Y');
            $to_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['item_id'] =''; 
            $data['lc_id'] =''; 
            $data['lc_info'] =''; 
            $data['all_orders'] = $this->m_common->get_row_array('rm_delivery_orders', array('is_active' => 1), '*');
           
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1,'customer_category'=>'Raw Material'), '*', '', '', 'c_name');
            if(!empty($from_date) & !empty($too_date)){
                //$sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,do.delivery_no,do.delivery_order_date,c.c_name,p.item_name,dc.driver_name,dc.truck_no,tmu.meas_unit from rm_delivery_challan_details dcd left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id left join rm_delivery_orders do on dod.do_id=do.do_id left join tbl_customers c on do.customer_id=c.id left join rm_items p on dcd.s_item_id=p.id left join tbl_measurement_unit tmu on p.mu_id=tmu.id  where $where and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.delivery_challan_date desc";
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,do.delivery_no,do.delivery_order_date,c.c_name,p.item_name,dc.driver_name,dc.truck_no,tmu.meas_unit,rlcr.mother_vessel_name 
                        from rm_delivery_challan_details dcd
                        left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id 
                        left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id 
                        left join rm_delivery_orders do on dod.do_id=do.do_id 
                        left join tbl_customers c on do.customer_id=c.id 
                        left join rm_items p on dcd.s_item_id=p.id 
                        left join tbl_measurement_unit tmu on p.mu_id=tmu.id  
                        left join import_lc_details lcd on dcd.lc_details_id=lcd.id
                        left join import_lc lc on lcd.lc_id=lc.lc_id
                        left join rm_lc_receive rlcr on lc.lc_id=rlcr.lc_id
                        where $where and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.delivery_challan_date desc";
            }else{
               // $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,do.delivery_no,do.delivery_order_date,c.c_name,p.item_name,dc.driver_name,dc.truck_no,tmu.meas_unit from rm_delivery_challan_details dcd left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id left join rm_delivery_orders do on dod.do_id=do.do_id left join tbl_customers c on do.customer_id=c.id left join rm_items p on dcd.s_item_id=p.id left join tbl_measurement_unit tmu on p.mu_id=tmu.id  where $where order by dc.delivery_challan_date desc";
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,do.delivery_no,do.delivery_order_date,c.c_name,p.item_name,dc.driver_name,dc.truck_no,tmu.meas_unit,rlcr.mother_vessel_name 
                        from rm_delivery_challan_details dcd
                        left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id 
                        left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id 
                        left join rm_delivery_orders do on dod.do_id=do.do_id 
                        left join tbl_customers c on do.customer_id=c.id 
                        left join rm_items p on dcd.s_item_id=p.id 
                        left join tbl_measurement_unit tmu on p.mu_id=tmu.id
                        left join import_lc_details lcd on dcd.lc_details_id=lcd.id
                        left join import_lc lc on lcd.lc_id=lc.lc_id
                        left join rm_lc_receive rlcr on lc.lc_id=rlcr.lc_id
                        where $where order by dc.delivery_challan_date desc";
            }
            $data['challans'] = $this->m_common->customeQuery($sql);
        }

        
        
        $lc_sql="select rlr.*,il.lc_no from rm_lc_receive rlr left join import_lc il on rlr.lc_id=il.lc_id";
        $data['lcs']=$this->m_common->customeQuery($lc_sql);
        
        $data['items']=$this->m_common->get_row_array('rm_items',array('is_active'=>1),'*');
        if($print == false){
            $this->load->view('raw_materials/sales_report/v_all_delivery_challan', $data);
        }else{
            $html = $this->load->view('raw_materials/sales_report/print_all_delivery_challan', $data, true);
            echo $html;
            exit;
        }
    }

    function allDeliveryChallanExcel($print = false) {
        $this->load->library("PHPExcel");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        $where = "dc.is_active=1";
        $postData = $this->input->post();
        if (!empty($postData)) {

            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            
            $order_id = $this->input->post('do_id');
           
            $bill_status=$this->input->post('bill_status');

            if(!empty($customer_id)){
                $data['all_orders'] = $this->m_common->get_row_array('rm_delivery_orders', array('is_active' =>1,'customer_id'=>$customer_id), '*');
            }else{
                $data['all_orders'] = $this->m_common->get_row_array('rm_delivery_orders', array('is_active' => 1), '*');
            }
            
            if (!empty($order_id)) {
                $data['do_id'] = $order_id;
                if (empty($where)) {
                    $where .= "do.do_id=$order_id";
                } else {
                    $where .= " and do.do_id=$order_id";
                }
            }

            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "do.customer_id=$customer_id";
                } else {
                    $where .= " and do.customer_id=$customer_id";
                }
                
            } 

            
            if (!empty($bill_status)) {
                $data['bill_status'] = $bill_status;
                if (empty($where)) {
                    $where .= "dcd.bill_status='$bill_status'";
                } else {
                    $where .= " and dcd.bill_status='$bill_status'";
                }
            }else{
                $data['bill_status'] ='';
            }
            
            
            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            }


            if(!empty($f_date) & !empty($to_date)){
               // $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,do.delivery_no,do.delivery_order_date,c.c_name,p.item_name,dc.driver_name,dc.truck_no,tmu.meas_unit from rm_delivery_challan_details dcd left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id left join rm_delivery_orders do on dod.do_id=do.do_id left join tbl_customers c on do.customer_id=c.id left join rm_items p on dcd.s_item_id=p.id left join tbl_measurement_unit tmu on p.mu_id=tmu.id where $where and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.delivery_challan_date desc";
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,do.delivery_no,do.delivery_order_date,c.c_name,p.item_name,dc.driver_name,dc.truck_no,tmu.meas_unit,rlcr.mother_vessel_name
                        from rm_delivery_challan_details dcd
                        left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id 
                        left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id 
                        left join rm_delivery_orders do on dod.do_id=do.do_id 
                        left join tbl_customers c on do.customer_id=c.id 
                        left join rm_items p on dcd.s_item_id=p.id 
                        left join tbl_measurement_unit tmu on p.mu_id=tmu.id 
                        left join import_lc_details lcd on dcd.lc_details_id=lcd.id 
                        left join import_lc lc on lcd.lc_id=lc.lc_id
                        left join rm_lc_receive rlcr on lc.lc_id=rlcr.lc_id
                        where $where and dc.status='Approved' and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.delivery_challan_date desc";
            }else{
                //$sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,do.delivery_no,do.delivery_order_date,c.c_name,p.item_name,dc.driver_name,dc.truck_no,tmu.meas_unit from rm_delivery_challan_details dcd left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id left join rm_delivery_orders do on dod.do_id=do.do_id left join tbl_customers c on do.customer_id=c.id left join rm_items p on dcd.s_item_id=p.id left join tbl_measurement_unit tmu on p.mu_id=tmu.id where $where order by dc.delivery_challan_date desc";
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,do.delivery_no,do.delivery_order_date,c.c_name,p.item_name,dc.driver_name,dc.truck_no,tmu.meas_unit,rlcr.mother_vessel_name
                        from rm_delivery_challan_details dcd 
                        left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id 
                        left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id 
                        left join rm_delivery_orders do on dod.do_id=do.do_id 
                        left join tbl_customers c on do.customer_id=c.id 
                        left join rm_items p on dcd.s_item_id=p.id 
                        left join tbl_measurement_unit tmu on p.mu_id=tmu.id 
                        left join import_lc_details lcd on dcd.lc_details_id=lcd.id 
                        left join import_lc lc on lcd.lc_id=lc.lc_id
                        left join rm_lc_receive rlcr on lc.lc_id=rlcr.lc_id
                        where $where and dc.status='Approved' order by dc.delivery_challan_date desc";
            }
            $data['challans'] = $this->m_common->customeQuery($sql);
            
            
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1,'customer_category'=>'Raw Material'), '*', '', '', 'c_name');
        }else{
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $to_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
           

            $data['all_orders'] = $this->m_common->get_row_array('rm_delivery_orders', array('is_active' => 1), '*');
           
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1,'customer_category'=>'Raw Material'), '*', '', '', 'c_name');
            if(!empty($from_date) & !empty($too_date)){
              //  $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,do.delivery_no,do.delivery_order_date,c.c_name,p.item_name,dc.driver_name,dc.truck_no,tmu.meas_unit from rm_delivery_challan_details dcd left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id left join rm_delivery_orders do on dod.do_id=do.do_id left join tbl_customers c on do.customer_id=c.id left join rm_items p on dcd.s_item_id=p.id left join tbl_measurement_unit tmu on p.mu_id=tmu.id  where $where and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.delivery_challan_date desc";
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,do.delivery_no,do.delivery_order_date,c.c_name,p.item_name,dc.driver_name,dc.truck_no,tmu.meas_unit,rlcr.mother_vessel_name 
                        from rm_delivery_challan_details dcd
                        left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id 
                        left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id 
                        left join rm_delivery_orders do on dod.do_id=do.do_id 
                        left join tbl_customers c on do.customer_id=c.id 
                        left join rm_items p on dcd.s_item_id=p.id 
                        left join tbl_measurement_unit tmu on p.mu_id=tmu.id  
                        left join import_lc_details lcd on dcd.lc_details_id=lcd.id
                        left join import_lc lc on lcd.lc_id=lc.lc_id
                        left join rm_lc_receive rlcr on lc.lc_id=rlcr.lc_id
                        where $where and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.delivery_challan_date desc";
            }else{
                //$sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,do.delivery_no,do.delivery_order_date,c.c_name,p.item_name,dc.driver_name,dc.truck_no,tmu.meas_unit from rm_delivery_challan_details dcd left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id left join rm_delivery_orders do on dod.do_id=do.do_id left join tbl_customers c on do.customer_id=c.id left join rm_items p on dcd.s_item_id=p.id left join tbl_measurement_unit tmu on p.mu_id=tmu.id  where $where order by dc.delivery_challan_date desc";
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,do.delivery_no,do.delivery_order_date,c.c_name,p.item_name,dc.driver_name,dc.truck_no,tmu.meas_unit,rlcr.mother_vessel_name 
                        from rm_delivery_challan_details dcd
                        left join rm_delivery_challans dc on dcd.dc_id=dc.dc_id 
                        left join rm_delivery_orders_details dod on dcd.do_details_id=dod.do_details_id 
                        left join rm_delivery_orders do on dod.do_id=do.do_id 
                        left join tbl_customers c on do.customer_id=c.id 
                        left join rm_items p on dcd.s_item_id=p.id 
                        left join tbl_measurement_unit tmu on p.mu_id=tmu.id
                        left join import_lc_details lcd on dcd.lc_details_id=lcd.id
                        left join import_lc lc on lcd.lc_id=lc.lc_id
                        left join rm_lc_receive rlcr on lc.lc_id=rlcr.lc_id
                        where $where order by dc.delivery_challan_date desc";
            }
            $data['challans'] = $this->m_common->customeQuery($sql);
        }

        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Delivery Challan');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:Q3')->applyFromArray($style);

        $table_columns = array("SL","Vessel Name", "C. Date.", "C. No.", "D.O.","C.Name","Truck No", "D.Name","P.Name", "M.Unit", "Quantity", "Unit Price", "Value","Bill Status");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:U5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:U5')->getFont()->setBold(true);


        $excel_row = 6;
        if (!empty($data['challans'])) {
            $total = 0;
            $total_value=0;
            $i = 0;
            foreach ($data['challans'] as $challan) {
                $i++;
                
                $total = $total + $challan['quantity'];
                $total_value=$total_value+round($challan['quantity']*$challan['unit_price'],2);
               

                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $challan['mother_vessel_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, date('d-m-Y', strtotime($challan['delivery_challan_date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $challan['dc_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $challan['delivery_no']);
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $challan['c_name']);
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $challan['truck_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $challan['driver_name']);
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $challan['item_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $challan['meas_unit']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, round($challan['quantity'], 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, $challan['unit_price']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, round($challan['quantity']*$challan['unit_price'], 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, $challan['bill_status']);

                $excel_row++;
            }
        }
        
        $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row,'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row,round($total, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, '');
        $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row,round($total_value, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, '');

        $object->getActiveSheet()->getStyle("L$excel_row:V$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("L$excel_row:V$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        
        $object->getActiveSheet()->getStyle('F5:S' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('R6:R'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'S'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="report.xls"');
        $object_writer->save('php://output');
    }
    
    
    function cancelChallan($print = false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        $where = "so.unit_id=$branch_id";
        $postData = $this->input->post();
        if (!empty($postData)) {

            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $category_id = $this->input->post('category_id');
            $bill_status=$this->input->post('bill_status');
//           if(!empty($customer_id)){
//               $data['customer_id']=$customer_id;
//                if(empty($where)){
//                    $where.="so.customer_id=$customer_id";
//                }else{
//                    $where.=" and so.customer_id=$customer_id";
//                }
//           }


            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "so.customer_id=$customer_id";
                } else {
                    $where .= " and so.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }



            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    $where .= "so.project_id=$project_id";
                } else {
                    $where .= " and so.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "do.o_id=$order_id";
                } else {
                    $where .= " and do.o_id=$order_id";
                }
            }

            if (!empty($product_id)) {
                $data['product_id'] = $product_id;
                if (empty($where)) {
                    $where .= "p.product_id=$product_id";
                } else {
                    $where .= " and p.product_id=$product_id";
                }
            }
            
            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "p.category_id=$category_id";
                } else {
                    $where .= " and p.category_id=$category_id";
                }
            }

            if (!empty($bill_status)) {
                $data['bill_status'] = $bill_status;
                if (empty($where)) {
                    $where .= "dcd.bill_status='$bill_status'";
                } else {
                    $where .= " and dcd.bill_status='$bill_status'";
                }
            }else{
                $data['bill_status'] ='';
            }
            
            
            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                //$data['f_date'] = $from_date = date('Y-m-01');
                //$data['to_date'] = $too_date = date('Y-m-t');
                //$f_date = date('d-m-Y');
                //$to_date = date('t-m-Y');
                $data['f_date'] ='';
                $data['to_date'] = '';
            }


           
            if(!empty($f_date) & !empty($to_date)){
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.remark,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.status='Canceled' and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            }else if(!empty($f_date)){
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.remark,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.status='Canceled' and dc.delivery_challan_date>='" . $from_date . "' order by dc.dc_id desc";
            } else if (!empty($to_date)){
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.remark,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.status='Canceled' and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            }else{
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.remark,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.status='Canceled' order by dc.dc_id desc ";
            }
            
            $data['challans'] = $this->m_common->customeQuery($sql);
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
//            $data['f_date'] = $from_date = date('Y-m-01');
//            $data['to_date'] = $too_date = date('Y-m-t');
            
            $data['f_date'] ='';
            $data['to_date'] = '';
            $f_date = date('d-m-Y');
            $to_date = date('t-m-Y');
            
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';
            $data['category_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
           
            $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.remark,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.status='Canceled' order by dc.dc_id desc ";
            
            $data['challans'] = $this->m_common->customeQuery($sql);
        }

        
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*');
        
        
        if ($print == false) {
            $this->load->view('sales_report/v_all_cancel_challan', $data);
        } else {
            $html = $this->load->view('sales_report/print_all_cancel_challan', $data, true);
            echo $html;
            exit;
        }
    }

    function cancelChallanExcel($print = false) {
        $this->load->library("PHPExcel");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        $where = "so.unit_id=$branch_id";
        $postData = $this->input->post();
        if (!empty($postData)) {

            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $category_id = $this->input->post('category_id');
            $bill_status=$this->input->post('bill_status');



            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "so.customer_id=$customer_id";
                } else {
                    $where .= " and so.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }



            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    $where .= "so.project_id=$project_id";
                } else {
                    $where .= " and so.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "do.o_id=$order_id";
                } else {
                    $where .= " and do.o_id=$order_id";
                }
            }

            if (!empty($product_id)) {
                $data['product_id'] = $product_id;
                if (empty($where)) {
                    $where .= "p.product_id=$product_id";
                } else {
                    $where .= " and p.product_id=$product_id";
                }
            }
            
            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "p.category_id=$category_id";
                } else {
                    $where .= " and p.category_id=$category_id";
                }
            }

            if (!empty($bill_status)) {
                $data['bill_status'] = $bill_status;
                if (empty($where)) {
                    $where .= "dcd.bill_status='$bill_status'";
                } else {
                    $where .= " and dcd.bill_status='$bill_status'";
                }
            }else{
                $data['bill_status'] ='';
            }
            
            
            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $to_date = date('t-m-Y');
            }


           
            if(!empty($f_date) & !empty($to_date)){
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.remark,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.status='Canceled' and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            }else if(!empty($f_date)){
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.remark,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.status='Canceled' and dc.delivery_challan_date>='" . $from_date . "' order by dc.dc_id desc";
            } else if (!empty($to_date)){
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.status='Canceled' and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            }else{
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.remark,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.status='Canceled' order by dc.dc_id desc ";
            }
            
            $data['challans'] = $this->m_common->customeQuery($sql);
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $to_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';
            $data['category_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
           
            $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.remark,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.status='Canceled' order by dc.dc_id desc ";
            
            $data['challans'] = $this->m_common->customeQuery($sql);
        }

        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Canceled Challan');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:Q3')->applyFromArray($style);

        $table_columns = array("SL", "C. Date.", "C. No.", "D.O.", "S.O.", "C.Name", "Project","Truck No", "D.Name","P.Type","P.Name", "M.Unit", "Quantity", "Unit Price", "Value","Bill Status","Remark");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:U5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:U5')->getFont()->setBold(true);


        $excel_row = 6;
        if (!empty($data['challans'])) {
            $total = 0;
            $total_value=0;
            $i = 0;
            foreach ($data['challans'] as $challan) {
                $i++;
                if ($order['product_name'] != 'Grouting') {
                    $total = $total + $challan['quantity'];
                    $total_value=$total_value+round($challan['quantity']*$challan['unit_price'],2);
                }

                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y', strtotime($challan['delivery_challan_date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $challan['dc_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $challan['delivery_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $challan['order_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $challan['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $challan['project_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $challan['truck_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $challan['driver_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $challan['category_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $challan['product_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, $challan['measurement_unit']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, round($challan['quantity'], 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, $challan['unit_price']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, round($challan['quantity']*$challan['unit_price'], 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(20, $excel_row, $challan['bill_status']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, $challan['remark']);

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row,'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row,round($total, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, '');
        $object->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row,round($total_value, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(20, $excel_row, '');
        $object->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, '');

        $object->getActiveSheet()->getStyle("L$excel_row:V$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("L$excel_row:V$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:V' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('R6:T'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'V'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="cancelChallan.xls"');
        $object_writer->save('php://output');
    }
    
    function challanInvoiceComparison($print = false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        $where = "so.unit_id=$branch_id";
        $postData = $this->input->post();
        if (!empty($postData)) {

            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $category_id = $this->input->post('category_id');
            $bill_status=$this->input->post('bill_status');



            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "so.customer_id=$customer_id";
                } else {
                    $where .= " and so.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }



            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    $where .= "so.project_id=$project_id";
                } else {
                    $where .= " and so.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "do.o_id=$order_id";
                } else {
                    $where .= " and do.o_id=$order_id";
                }
            }

            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "p.category_id=$category_id";
                } else {
                    $where .= " and p.category_id=$category_id";
                }
            }
            
            if (!empty($product_id)) {
                $data['product_id'] = $product_id;
                if (empty($where)) {
                    $where .= "p.product_id=$product_id";
                } else {
                    $where .= " and p.product_id=$product_id";
                }
            }

            if (!empty($bill_status)) {
                $data['bill_status'] = $bill_status;
                if (empty($where)) {
                    $where .= "dcd.bill_status='$bill_status'";
                } else {
                    $where .= " and dcd.bill_status='$bill_status'";
                }
            }else{
                $data['bill_status'] ='';
            }
            
            
            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $to_date = date('t-m-Y');
            }


            if (!empty($f_date) & !empty($to_date)) {
                $sql = "select dcd.*,(select SUM(quantity) from tbl_sales_invoice_details where s_item_id=dcd.s_item_id AND dc_id=dcd.dc_id) total_invoie_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.status='Approved' and dc.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            } else if (!empty($f_date)) {
                $sql = "select dcd.*,(select SUM(quantity) from tbl_sales_invoice_details where s_item_id=dcd.s_item_id AND dc_id=dcd.dc_id) total_invoie_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.status='Approved' and dc.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' order by dc.dc_id desc";
            } else if (!empty($to_date)) {
                $sql = "select dcd.*,(select SUM(quantity) from tbl_sales_invoice_details where s_item_id=dcd.s_item_id AND dc_id=dcd.dc_id) total_invoie_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.status='Approved' and dc.is_active=1 and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            } else {
                $sql = "select dcd.*,(select SUM(quantity) from tbl_sales_invoice_details where s_item_id=dcd.s_item_id AND dc_id=dcd.dc_id) total_invoie_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.status='Approved' and dc.is_active=1 order by dc.dc_id desc ";
            }
            $data['challans'] = $this->m_common->customeQuery($sql);
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $to_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';
            $data['category_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            if (!empty($f_date) & !empty($to_date)) {
                $sql = "select dcd.*,(select SUM(quantity) from tbl_sales_invoice_details where s_item_id=dcd.s_item_id AND dc_id=dcd.dc_id) total_invoie_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.status='Approved' and dc.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            } else if (!empty($f_date)) {
                $sql = "select dcd.*,(select SUM(quantity) from tbl_sales_invoice_details where s_item_id=dcd.s_item_id AND dc_id=dcd.dc_id) total_invoie_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.status='Approved' and dc.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' order by dc.dc_id desc";
            } else if (!empty($to_date)) {
                $sql = "select dcd.*,(select SUM(quantity) from tbl_sales_invoice_details where s_item_id=dcd.s_item_id AND dc_id=dcd.dc_id) total_invoie_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.status='Approved' and dc.is_active=1 and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            } else {
                $sql = "select dcd.*,(select SUM(quantity) from tbl_sales_invoice_details where s_item_id=dcd.s_item_id AND dc_id=dcd.dc_id) total_invoie_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.status='Approved' and dc.is_active=1 order by dc.dc_id desc ";
            }
            $data['challans'] = $this->m_common->customeQuery($sql);
        }

        
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*');
        
        if ($print == false) {
            $this->load->view('sales_report/v_all_challan_invoice_comparison', $data);
        } else {
            $html = $this->load->view('sales_report/print_all_challan_invoice_comparison', $data, true);
            echo $html;
            exit;
        }
    }

    function challanInvoiceComparisonExcel($print = false) {
        $this->load->library("PHPExcel");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        $where = "so.unit_id=$branch_id";
        $postData = $this->input->post();
        if (!empty($postData)) {

            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $category_id = $this->input->post('category_id');
            $bill_status=$this->input->post('bill_status');
//           if(!empty($customer_id)){
//               $data['customer_id']=$customer_id;
//                if(empty($where)){
//                    $where.="so.customer_id=$customer_id";
//                }else{
//                    $where.=" and so.customer_id=$customer_id";
//                }
//           }


            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "so.customer_id=$customer_id";
                } else {
                    $where .= " and so.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }



            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    $where .= "so.project_id=$project_id";
                } else {
                    $where .= " and so.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "do.o_id=$order_id";
                } else {
                    $where .= " and do.o_id=$order_id";
                }
            }

            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "p.category_id=$category_id";
                } else {
                    $where .= " and p.category_id=$category_id";
                }
            }
            
            if (!empty($product_id)) {
                $data['product_id'] = $product_id;
                if (empty($where)) {
                    $where .= "p.product_id=$product_id";
                } else {
                    $where .= " and p.product_id=$product_id";
                }
            }

            if (!empty($bill_status)) {
                $data['bill_status'] = $bill_status;
                if (empty($where)) {
                    $where .= "dcd.bill_status='$bill_status'";
                } else {
                    $where .= " and dcd.bill_status='$bill_status'";
                }
            }else{
                $data['bill_status'] ='';
            }
            
            
            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $to_date = date('t-m-Y');
            }


            if (!empty($f_date) & !empty($to_date)) {
                $sql = "select dcd.*,(select SUM(quantity) from tbl_sales_invoice_details where s_item_id=dcd.s_item_id AND dc_id=dcd.dc_id) total_invoie_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.status='Approved' and dc.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            } else if (!empty($f_date)) {
                $sql = "select dcd.*,(select SUM(quantity) from tbl_sales_invoice_details where s_item_id=dcd.s_item_id AND dc_id=dcd.dc_id) total_invoie_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.status='Approved' and dc.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' order by dc.dc_id desc";
            } else if (!empty($to_date)) {
                $sql = "select dcd.*,(select SUM(quantity) from tbl_sales_invoice_details where s_item_id=dcd.s_item_id AND dc_id=dcd.dc_id) total_invoie_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.status='Approved' and dc.is_active=1 and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            } else {
                $sql = "select dcd.*,(select SUM(quantity) from tbl_sales_invoice_details where s_item_id=dcd.s_item_id AND dc_id=dcd.dc_id) total_invoie_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.status='Approved' and dc.is_active=1 order by dc.dc_id desc ";
            }
            $data['challans'] = $this->m_common->customeQuery($sql);
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $to_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';
            $data['category_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            if (!empty($f_date) & !empty($to_date)) {
                $sql = "select dcd.*,(select SUM(quantity) from tbl_sales_invoice_details where s_item_id=dcd.s_item_id AND dc_id=dcd.dc_id) total_invoie_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.status='Approved' and dc.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            } else if (!empty($f_date)) {
                $sql = "select dcd.*,(select SUM(quantity) from tbl_sales_invoice_details where s_item_id=dcd.s_item_id AND dc_id=dcd.dc_id) total_invoie_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.status='Approved' and dc.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' order by dc.dc_id desc";
            } else if (!empty($to_date)) {
                $sql = "select dcd.*,(select SUM(quantity) from tbl_sales_invoice_details where s_item_id=dcd.s_item_id AND dc_id=dcd.dc_id) total_invoie_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.status='Approved' and dc.is_active=1 and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            } else {
                $sql = "select dcd.*,(select SUM(quantity) from tbl_sales_invoice_details where s_item_id=dcd.s_item_id AND dc_id=dcd.dc_id) total_invoie_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.status='Approved' and dc.is_active=1 order by dc.dc_id desc ";
            }
            $data['challans'] = $this->m_common->customeQuery($sql);
        }

        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Challan And Invoice Comparison');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:V3')->applyFromArray($style);

        $table_columns = array("SL", "C. Date.", "C. No.", "D.O.", "S.O.", "C.Name", "Project","P.Type", "P.Name", "M.Unit","Unit Price", "Challan Qty", "Invoice Qty", "Invoice Due Qty","Challan Amount", "Invoice Amount", "Invoice Due Amount");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:V5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:V5')->getFont()->setBold(true);


        $excel_row = 6;
        if (!empty($data['challans'])) {
            $total=0;
            $total_ch_amount=0;
            $total_inv_amount=0;
            
            $i = 0;
            foreach ($data['challans'] as $challan) {
                $i++;
                if ($order['product_name'] != 'Grouting') {
                    //$total = $total + $challan['quantity'];
                }

                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y', strtotime($challan['delivery_challan_date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $challan['dc_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $challan['delivery_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $challan['order_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $challan['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $challan['project_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $challan['category_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $challan['product_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $challan['measurement_unit']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $challan['unit_price']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, round($challan['quantity'], 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, round($challan['total_invoie_qty'], 2));
                $in_due_qty=$challan['quantity']-$challan['total_invoie_qty'];
                $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row,round($in_due_qty, 2));
                if(!empty($challan['quantity'])){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(19,$excel_row,round($challan['quantity']*$challan['unit_price'], 2));
                }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(19,$excel_row,'');
                } 
                
                if(!empty($challan['total_invoie_qty'])){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(20, round($excel_row,$challan['total_invoie_qty']*$challan['unit_price'],2));
                }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(20, $excel_row,'');
                }    
                
                
                               
                if(!empty($challan['quantity'])){ 
                    $ch_amount=$challan['quantity']*$challan['unit_price'];

                }else{
                   $ch_amount=''; 
                }  
                $total_ch_amount=$total_ch_amount+$ch_amount;

                if(!empty($challan['total_invoie_qty'])){ 
                    $in_amount=$challan['total_invoie_qty']*$challan['unit_price'];

                }else{
                   $in_amount=''; 
                }
                $total_inv_amount=$total_inv_amount+$in_amount;

                $due_in_amount=$ch_amount-$in_amount;
                
                if($order['product_name']!='Grouting'){
                    $total=$total+$due_in_amount;
                }
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, round($due_in_amount, 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, 'Total');
       // $object->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, number_format($total_ch_amount, 2));
      //  $object->getActiveSheet()->setCellValueByColumnAndRow(20, $excel_row, number_format($total_inv_amount, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, round($total_ch_amount, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(20, $excel_row, round($total_inv_amount, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, round($total,2));

        $object->getActiveSheet()->getStyle("L$excel_row:V$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("L$excel_row:V$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:V' . $excel_row)->applyFromArray($styleArray);
        

        // Auto size columns for each worksheet
        for ($col = 'F';$col !== 'V';$col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

       // $object->getActiveSheet()->getStyle('T6:T'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
       // $object->getActiveSheet()->getStyle('V6:V'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        
        $object->getActiveSheet()->getStyle('Q6:V'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        
        
        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="report.xls"');
        $object_writer->save('php://output');
    }
    
    function invoiceSummaryReport($print = false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $b_id = $this->input->post('branch_id');
        if(!empty($b_id)){
            $branch_id =$b_id; 
        }else{
            $branch_id=$this->session->userdata('companyId');
        }
        $data['employees'] = $this->m_common->get_row_array('employees','', '*');
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*'); 
        $data['branch_info'] = $this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
        
        $data['branches'] = $this->m_common->get_row_array('department','','*');
        $where = '';
        
       // $where .="tsi.unit_id=".$branch_id;
        $where .= "tsi.is_active=1";
        $postData = $this->input->post();
        if (!empty($postData)) {
            $b_id = $this->input->post('branch_id');
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $category_id = $this->input->post('category_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $bill_status=$this->input->post('bill_status');
            $s_p_id=$this->input->post('sale_person_id');
            
            if (!empty($b_id)){
                $data['branch_id']=$b_id;
                if (empty($where)) {
                   // $where .= "so.customer_id=$customer_id";
                    $where .= "tsi.unit_id=$b_id";
                } else {
                    //$where .= " and so.customer_id=$customer_id";
                    $where .= " and tsi.unit_id=$b_id";
                }
                
            } else {
                $data['branch_id'] = '';
            }
            
            

            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                   // $where .= "so.customer_id=$customer_id";
                    $where .= "tsi.customer_id=$customer_id";
                } else {
                    //$where .= " and so.customer_id=$customer_id";
                    $where .= " and tsi.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }

            
            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "tsi.category_id=$category_id";
                } else {
                    $where .= " and tsi.category_id=$category_id";
                }
            } else {
                $data['category_id'] = '';
            }

            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                   // $where .= "so.project_id=$project_id";
                    $where .= "tsi.project_id=$project_id";
                } else {
                    $where .= " and tsi.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "so.o_id=$order_id";
                } else {
                    $where .= " and so.o_id=$order_id";
                }
            }

           
            if (!empty($s_p_id)) {
                $data['sale_person_id'] = $s_p_id;
                if (empty($where)) {
                    $where .= "so.sale_person_id=$s_p_id";
                } else {
                    $where .= " and so.sale_person_id=$s_p_id";
                }
            } else {
                $data['sale_person_id'] = '';
            }
            
            
            if(!empty($f_date) & !empty($to_date)){
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $too_date = date('t-m-Y');
            }


            if(!empty($f_date) & !empty($to_date)){
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.is_active=1 and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
            }else if (!empty($f_date)){                
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC";
            }else if (!empty($to_date)){
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
            }else{
              //  $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
              //  $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1";
            }
            $data['invoices'] = $this->m_common->customeQuery($sql);
            
            foreach($data['invoices'] as $key=>$value){
              //  $s_d="select sum(quantity) as total_amount,unit_price,mu_name from tbl_sales_invoice_details where amount>0 and inv_id=".$value['inv_id'];
                $s_d="select sum(quantity) as total_amount,unit_price,mu_name,tsp.product_name from tbl_sales_invoice_details tsid left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id  where amount>0 and inv_id=".$value['inv_id'];
                $t_amount=$this->m_common->customeQuery($s_d);
                $data['invoices'][$key]['total_qty']=$t_amount[0]['total_amount'];
                $data['invoices'][$key]['unit_price']=$t_amount[0]['unit_price'];
                $data['invoices'][$key]['mu_name']=$t_amount[0]['mu_name'];
                $data['invoices'][$key]['product_name']=$t_amount[0]['product_name'];
            
            }
            
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $too_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            if(!empty($f_date) & !empty($to_date)){
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.is_active=1 and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
            }else if (!empty($f_date)){                
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC";
            }else if (!empty($to_date)){
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
            }else{
              //  $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
              //  $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1"; //2021-02-14
                  $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1";
            }
            
            $data['invoices'] = $this->m_common->customeQuery($sql);
            
            foreach($data['invoices'] as $key=>$value){
                $s_d="select sum(quantity) as total_amount,unit_price,mu_name,tsp.product_name from tbl_sales_invoice_details tsid left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id  where amount>0 and inv_id=".$value['inv_id'];
                $t_amount=$this->m_common->customeQuery($s_d);
                $data['invoices'][$key]['total_qty']=$t_amount[0]['total_amount'];
                $data['invoices'][$key]['unit_price']=$t_amount[0]['unit_price'];
                $data['invoices'][$key]['mu_name']=$t_amount[0]['mu_name'];
                $data['invoices'][$key]['product_name']=$t_amount[0]['product_name'];
            
            }
        }
        
        
        

        if($print==false){
            $this->load->view('sales_report/v_invoice_summary_report', $data);
        } else {
            $html = $this->load->view('sales_report/print_invoice_summary_report', $data, true);
            echo $html;
            exit;
        }
    }
    
    
    function invoiceSummaryExcel($print = false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
       // $where = "so.unit_id=$branch_id";
        
      //  $where .="tsi.unit_id=".$branch_id;
        $where = "tsi.is_active=1";
        $postData = $this->input->post();
         if (!empty($postData)) {
            $b_id = $this->input->post('branch_id');
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $category_id = $this->input->post('category_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $bill_status=$this->input->post('bill_status');
            $s_p_id=$this->input->post('sale_person_id');
            
            if (!empty($b_id)){
                $data['branch_id']=$b_id;
                if (empty($where)) {
                   // $where .= "so.customer_id=$customer_id";
                    $where .= "tsi.unit_id=$b_id";
                } else {
                    //$where .= " and so.customer_id=$customer_id";
                    $where .= " and tsi.unit_id=$b_id";
                }
                
            } else {
                $data['branch_id'] = '';
            }
            
            

            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                   // $where .= "so.customer_id=$customer_id";
                    $where .= "tsi.customer_id=$customer_id";
                } else {
                    //$where .= " and so.customer_id=$customer_id";
                    $where .= " and tsi.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }

            
            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "tsi.category_id=$category_id";
                } else {
                    $where .= " and tsi.category_id=$category_id";
                }
            } else {
                $data['category_id'] = '';
            }

            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                   // $where .= "so.project_id=$project_id";
                    $where .= "tsi.project_id=$project_id";
                } else {
                    $where .= " and tsi.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "so.o_id=$order_id";
                } else {
                    $where .= " and so.o_id=$order_id";
                }
            }

           
            if (!empty($s_p_id)) {
                $data['sale_person_id'] = $s_p_id;
                if (empty($where)) {
                    $where .= "so.sale_person_id=$s_p_id";
                } else {
                    $where .= " and so.sale_person_id=$s_p_id";
                }
            } else {
                $data['sale_person_id'] = '';
            }
            
            
            if(!empty($f_date) & !empty($to_date)){
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $too_date = date('t-m-Y');
            }


            if(!empty($f_date) & !empty($to_date)){
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.is_active=1 and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
            }else if (!empty($f_date)){                
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC";
            }else if (!empty($to_date)){
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
            }else{
              //  $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
              //  $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1";
            }
            $data['invoices'] = $this->m_common->customeQuery($sql);
            
            foreach($data['invoices'] as $key=>$value){
              //  $s_d="select sum(quantity) as total_amount,unit_price,mu_name from tbl_sales_invoice_details where amount>0 and inv_id=".$value['inv_id'];
                $s_d="select sum(quantity) as total_amount,unit_price,mu_name,tsp.product_name from tbl_sales_invoice_details tsid left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id  where amount>0 and inv_id=".$value['inv_id'];
                $t_amount=$this->m_common->customeQuery($s_d);
                $data['invoices'][$key]['total_qty']=$t_amount[0]['total_amount'];
                $data['invoices'][$key]['unit_price']=$t_amount[0]['unit_price'];
                $data['invoices'][$key]['mu_name']=$t_amount[0]['mu_name'];
                $data['invoices'][$key]['product_name']=$t_amount[0]['product_name'];
            
            }
            
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $too_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            if(!empty($f_date) & !empty($to_date)){
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.is_active=1 and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
            }else if (!empty($f_date)){                
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC";
            }else if (!empty($to_date)){
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
            }else{
              //  $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
              //  $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1"; //2021-02-14
                  $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1";
            }
            
            $data['invoices'] = $this->m_common->customeQuery($sql);
            
            foreach($data['invoices'] as $key=>$value){
                $s_d="select sum(quantity) as total_amount,unit_price,mu_name,tsp.product_name from tbl_sales_invoice_details tsid left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id  where amount>0 and inv_id=".$value['inv_id'];
                $t_amount=$this->m_common->customeQuery($s_d);
                $data['invoices'][$key]['total_qty']=$t_amount[0]['total_amount'];
                $data['invoices'][$key]['unit_price']=$t_amount[0]['unit_price'];
                $data['invoices'][$key]['mu_name']=$t_amount[0]['mu_name'];
                $data['invoices'][$key]['product_name']=$t_amount[0]['product_name'];
            
            }
        }


        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Invoice Summary Report');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:Q3')->applyFromArray($style);

       // $table_columns = array("SL", "Invoice Date", "Inv. No.", "So.No.",  "C.Name", "Project","Amount","Paid Amount","Due Amount");
       // $table_columns = array("SL", "Invoice Date", "Inv. No.", "So.No.",  "C.Name", "Project","Product Name",'M.U.',"Quantity","Rate","Amount","Paid Amount","Due Amount"); //2021-02-14
        $table_columns = array("SL", "Invoice Date", "Inv. No.", "So.No.",  "C.Name", "Project","Product Name",'M.U.',"Quantity","Rate","Amount","Paid Amount","Due Amount","Sales Person");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setBold(true);


        $excel_row = 6;
        if (!empty($data['invoices'])){
            $total_qty=0;
            $total=0;
            $total_received=0;
            $total_due=0;
            $i = 0;
            foreach ($data['invoices'] as $invoice) {
                $due=0;
                $total_qty=$total_qty+$invoice['total_qty'];
                $total=$total+$invoice['total_amount'];
                $total_received=$total_received+$invoice['received_amount'];
                $i++;
                                            
                $due=$invoice['total_amount']-$invoice['received_amount'];
                $total_due=$total_due+$due;
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row,$i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row,date('d-m-Y', strtotime($invoice['sale_invoice_date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row,$invoice['inv_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,$invoice['order_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,$invoice['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10,$excel_row,$invoice['project_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11,$excel_row,$invoice['product_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12,$excel_row,$invoice['mu_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13,$excel_row,$invoice['total_qty']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(14,$excel_row,$invoice['unit_price']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(15,$excel_row,round($invoice['total_amount'], 2));
                if(!empty($invoice['received_amount'])){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row,round($invoice['received_amount'], 2));
                }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row,'');
                }
                if(!empty($due)){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, round($due, 2));
                }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row,'');
                }
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row,$invoice['name']);
//                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, number_format($invoice['quantity'], 2));
//                $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, number_format($invoice['truck_no'], 2));
//                $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, number_format($invoice['driver_name'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, 'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, round($total_qty, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row,'');
        $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row,round($total,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row,round($total_received,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row,round($total_due,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row,'');

        $object->getActiveSheet()->getStyle("L$excel_row:Q$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("L$excel_row:Q$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:S' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('M6:R'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col='F';$col !=='Q';$col++){
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="invoiceSummaryReport.xls"');
        $object_writer->save('php://output');
    }
    
    
    
    
    
    
    function detailsInvoiceReport($print = false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        $where = "so.unit_id=$branch_id";
        $postData = $this->input->post();
        if (!empty($postData)) {

            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $bill_status=$this->input->post('bill_status');
//           if(!empty($customer_id)){
//               $data['customer_id']=$customer_id;
//                if(empty($where)){
//                    $where.="so.customer_id=$customer_id";
//                }else{
//                    $where.=" and so.customer_id=$customer_id";
//                }
//           }


            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "so.customer_id=$customer_id";
                } else {
                    $where .= " and so.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }



            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    $where .= "so.project_id=$project_id";
                } else {
                    $where .= " and so.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "do.o_id=$order_id";
                } else {
                    $where .= " and do.o_id=$order_id";
                }
            }

            if (!empty($product_id)) {
                $data['product_id'] = $product_id;
                if (empty($where)) {
                    $where .= "p.product_id=$product_id";
                } else {
                    $where .= " and p.product_id=$product_id";
                }
            }

            
            
            
            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $to_date = date('t-m-Y');
            }


            if (!empty($f_date) & !empty($to_date)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            } else if (!empty($f_date)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' order by dc.dc_id desc";
            } else if (!empty($to_date)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            } else {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
            }
            $data['challans'] = $this->m_common->customeQuery($sql);
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $to_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            if (!empty($f_date) & !empty($to_date)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            } else if (!empty($f_date)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' order by dc.dc_id desc";
            } else if (!empty($to_date)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            } else {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
            }
            $data['challans'] = $this->m_common->customeQuery($sql);
        }

        if ($print == false) {
            $this->load->view('sales_report/v_details_invoice_report', $data);
        } else {
            $html = $this->load->view('sales_report/print_all_delivery_challan', $data, true);
            echo $html;
            exit;
        }
    }

    function detailsInvoiceExcel($print = false) {
        $this->load->library("PHPExcel");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        $where = "so.unit_id=$branch_id";
        $postData = $this->input->post();
        if (!empty($postData)) {

            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
//           if(!empty($customer_id)){
//               $data['customer_id']=$customer_id;
//                if(empty($where)){
//                    $where.="so.customer_id=$customer_id";
//                }else{
//                    $where.=" and so.customer_id=$customer_id";
//                }
//           }


            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "so.customer_id=$customer_id";
                } else {
                    $where .= " and so.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }



            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    $where .= "so.project_id=$project_id";
                } else {
                    $where .= " and so.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "do.o_id=$order_id";
                } else {
                    $where .= " and do.o_id=$order_id";
                }
            }

            if (!empty($product_id)) {
                $data['product_id'] = $product_id;
                if (empty($where)) {
                    $where .= "p.product_id=$product_id";
                } else {
                    $where .= " and p.product_id=$product_id";
                }
            }

            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $to_date = date('t-m-Y');
            }


            if (!empty($f_date) & !empty($to_date)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            } else if (!empty($f_date)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' order by dc.dc_id desc";
            } else if (!empty($to_date)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            } else {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
            }
            $data['challans'] = $this->m_common->customeQuery($sql);
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $to_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            if (!empty($f_date) & !empty($to_date)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            } else if (!empty($f_date)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' order by dc.dc_id desc";
            } else if (!empty($to_date)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.delivery_challan_date<='" . $too_date . "' order by dc.dc_id desc";
            } else {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
            }
            $data['challans'] = $this->m_common->customeQuery($sql);
        }

        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Delivery Challan');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:Q3')->applyFromArray($style);

        $table_columns = array("SL", "C. Date.", "C. No.", "D.O.", "S.O.", "C.Name", "Project", "P.Name", "M.Unit", "Quantity", "Truck No", "D.Name");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:Q5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:Q5')->getFont()->setBold(true);


        $excel_row = 6;
        if (!empty($data['challans'])) {
            $total = 0;
            $i = 0;
            foreach ($data['challans'] as $challan) {
                $i++;
                if ($order['product_name'] != 'Grouting') {
                    $total = $total + $challan['quantity'];
                }

                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y', strtotime($challan['delivery_challan_date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $challan['dc_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $challan['delivery_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $challan['order_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $challan['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $challan['project_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $challan['product_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $challan['measurement_unit']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, round($challan['quantity'], 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row,$challan['truck_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row,$challan['driver_name']);

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, 'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, round($total, 2));

        $object->getActiveSheet()->getStyle("L$excel_row:Q$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("L$excel_row:Q$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:Q' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('O6:O'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'Q'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="report.xls"');
        $object_writer->save('php://output');
    }
    

    function allDeliveryChallanTimewise($print = false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        $where = "so.unit_id=$branch_id";
        $postData = $this->input->post();
        if (!empty($postData)) {
            $date = date('Y-m-d', strtotime($this->input->post('date')));
            $data['date'] = $this->input->post('date');
            $f_time = $this->input->post('from_time');
            $to_time = $this->input->post('to_time');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $category_id = $this->input->post('category_id');
//           if(!empty($customer_id)){
//               $data['customer_id']=$customer_id;
//                if(empty($where)){
//                    $where.="so.customer_id=$customer_id";
//                }else{
//                    $where.=" and so.customer_id=$customer_id";
//                }
//           }


            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "so.customer_id=$customer_id";
                } else {
                    $where .= " and so.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }



            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    $where .= "so.project_id=$project_id";
                } else {
                    $where .= " and so.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "do.o_id=$order_id";
                } else {
                    $where .= " and do.o_id=$order_id";
                }
            }

            if (!empty($product_id)) {
                $data['product_id'] = $product_id;
                if (empty($where)) {
                    $where .= "p.product_id=$product_id";
                } else {
                    $where .= " and p.product_id=$product_id";
                }
            }
            
            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "p.category_id=$category_id";
                } else {
                    $where .= " and p.category_id=$category_id";
                }
            }

            if (!empty($f_time) & !empty($to_time)) {

                //   $from_date = date('Y-m-d', strtotime($f_date));
                //   $too_date = date('Y-m-d', strtotime($to_date));

                $from_time = date('Y-m-d H:i:s', strtotime($date . ' ' . $postData['from_time']));
                $to_time = date('Y-m-d H:i:s', strtotime($date . ' ' . $postData['to_time']));

                $data['f_time'] = $from_time;
                $data['to_time'] = $to_time;
            } else if (!empty($f_time)) {
                $from_time = date('Y-m-d H:i:s', strtotime($date . ' ' . $postData['from_time']));
                $data['f_time'] = $from_time;
                $data['to_time'] = '';
            } else if (!empty($to_time)) {
                $to_time = date('Y-m-d H:i:s', strtotime($date . ' ' . $postData['to_time']));
                $data['f_time'] = '';
                $data['to_time'] = $to_time;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $to_date = date('t-m-Y');
            }


            if (!empty($f_time) & !empty($to_time)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.challan_date_time,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.challan_date_time>='" . $from_time . "' and dc.challan_date_time<='" . $to_time . "' order by dc.dc_id desc";
            } else if (!empty($f_time)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.challan_date_time,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.challan_date_time>='" . $from_time . "' order by dc.dc_id desc";
            } else if (!empty($to_time)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.challan_date_time,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.challan_date_time<='" . $to_time . "' order by dc.dc_id desc";
            } else {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.challan_date_time,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left left join tbl_product_categories tpc on p.category_id=tpc.category_id join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
            }
            $data['challans'] = $this->m_common->customeQuery($sql);
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $to_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';
            $data['category_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
//            if (!empty($f_date) & !empty($to_date)) {
//                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.challan_date_time,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.challan_date_time>='" . $from_date . "' and dc.challan_date_time<='" . $too_date . "' order by dc.dc_id desc";
//            } else if (!empty($f_date)) {
//                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.challan_date_time,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.challan_date_time>='" . $from_date . "' order by dc.dc_id desc";
//            } else if (!empty($to_date)) {
//                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.challan_date_time,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.challan_date_time<='" . $too_date . "' order by dc.dc_id desc";
//            } else {
//                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.challan_date_time,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
//            }
//            $data['challans'] = $this->m_common->customeQuery($sql);
            $data['challans'] = '';
        }

        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*');
        
        if ($print == false) {
            $this->load->view('sales_report/v_all_delivery_challan_time_wise', $data);
        } else {
            $html = $this->load->view('sales_report/print_all_delivery_challan_time_wise', $data, true);
            echo $html;
            exit;
        }
    }

    function allDeliveryChallanTimewiseExcel($print = false) {
        $this->load->library("PHPExcel");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        $where = "so.unit_id=$branch_id";
        $postData = $this->input->post();
        if (!empty($postData)) {
            $date = date('Y-m-d', strtotime($this->input->post('date')));
            $data['date'] = $this->input->post('date');
            $f_time = $this->input->post('from_time');
            $to_time = $this->input->post('to_time');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $category_id = $this->input->post('category_id');
//           if(!empty($customer_id)){
//               $data['customer_id']=$customer_id;
//                if(empty($where)){
//                    $where.="so.customer_id=$customer_id";
//                }else{
//                    $where.=" and so.customer_id=$customer_id";
//                }
//           }


            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "so.customer_id=$customer_id";
                } else {
                    $where .= " and so.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }



            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    $where .= "so.project_id=$project_id";
                } else {
                    $where .= " and so.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "do.o_id=$order_id";
                } else {
                    $where .= " and do.o_id=$order_id";
                }
            }

            if (!empty($product_id)) {
                $data['product_id'] = $product_id;
                if (empty($where)) {
                    $where .= "p.product_id=$product_id";
                } else {
                    $where .= " and p.product_id=$product_id";
                }
            }
            
            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "p.category_id=$category_id";
                } else {
                    $where .= " and p.category_id=$category_id";
                }
            }

            if (!empty($f_time) & !empty($to_time)) {

                //   $from_date = date('Y-m-d', strtotime($f_date));
                //   $too_date = date('Y-m-d', strtotime($to_date));

                $from_time = date('Y-m-d H:i:s', strtotime($date . ' ' . $postData['from_time']));
                $to_time = date('Y-m-d H:i:s', strtotime($date . ' ' . $postData['to_time']));

                $data['f_time'] = $from_time;
                $data['to_time'] = $to_time;
            } else if (!empty($f_time)) {
                $from_time = date('Y-m-d H:i:s', strtotime($date . ' ' . $postData['from_time']));
                $data['f_time'] = $from_time;
                $data['to_time'] = '';
            } else if (!empty($to_time)) {
                $to_time = date('Y-m-d H:i:s', strtotime($date . ' ' . $postData['to_time']));
                $data['f_time'] = '';
                $data['to_time'] = $to_time;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $to_date = date('t-m-Y');
            }


            if (!empty($f_time) & !empty($to_time)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.challan_date_time,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.challan_date_time>='" . $from_time . "' and dc.challan_date_time<='" . $to_time . "' order by dc.dc_id desc";
            } else if (!empty($f_time)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.challan_date_time,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.challan_date_time>='" . $from_time . "' order by dc.dc_id desc";
            } else if (!empty($to_time)) {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.challan_date_time,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.challan_date_time<='" . $to_time . "' order by dc.dc_id desc";
            } else {
                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.challan_date_time,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left left join tbl_product_categories tpc on p.category_id=tpc.category_id join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
            }
            $data['challans'] = $this->m_common->customeQuery($sql);
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $to_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';
            $data['category_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
//            if (!empty($f_date) & !empty($to_date)) {
//                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.challan_date_time,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.challan_date_time>='" . $from_date . "' and dc.challan_date_time<='" . $too_date . "' order by dc.dc_id desc";
//            } else if (!empty($f_date)) {
//                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.challan_date_time,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.challan_date_time>='" . $from_date . "' order by dc.dc_id desc";
//            } else if (!empty($to_date)) {
//                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.challan_date_time,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 and dc.challan_date_time<='" . $too_date . "' order by dc.dc_id desc";
//            } else {
//                $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,dc.challan_date_time,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
//            }
//            $data['challans'] = $this->m_common->customeQuery($sql);
            $data['challans'] = '';
        }

        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Delivery Challan Time Wise');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:S3')->applyFromArray($style);

        $table_columns = array("SL", "C. Date", "C. Time", "C. No.", "D.O.", "S.O.", "C.Name", "Project", "Truck No", "D.Name","P.Type", "P.Name", "M.Unit", "Quantity");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:S5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:S5')->getFont()->setBold(true);


        $excel_row = 6;
        if (!empty($data['challans'])) {
            $total = 0;
            $i = 0;
            foreach ($data['challans'] as $challan) {
                $i++;
                if ($order['product_name'] != 'Grouting') {
                    $total = $total + $challan['quantity'];
                }

                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y', strtotime($challan['delivery_challan_date'])));

                if (!empty($challan['challan_date_time'])) {
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, date('h:i A', strtotime($challan['challan_date_time'])));
                } else {
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, '');
                }

                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $challan['dc_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $challan['delivery_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $challan['order_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $challan['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $challan['project_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $challan['truck_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $challan['driver_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $challan['category_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, $challan['product_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, $challan['measurement_unit']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(18,$excel_row,round($challan['quantity'],2));

                $excel_row++;
            }
        }

        $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row,'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row,round($total,2));

        $object->getActiveSheet()->getStyle("L$excel_row:S$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("L$excel_row:S$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:S' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('S6:S'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'S'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="report.xls"');
        $object_writer->save('php://output');
    }

    function customerwiseChallan($print = false) {
        $this->menu ='sales';
        $this->sub_menu ='sale';
        $this->sub_inner_menu ='sales_report';
        $this->titlebackend("Customer Wise Challan Report");
        $user_type = $this->session->userdata('user_type');
        
        $b_id=$this->input->post('branch_id');
        if($user_type==3 || $user_type==1){
            if(!empty($b_id)){
                $branch_id =$b_id; 
            }else{
                $branch_id='';
            }
            $data['branch_id']=$b_id;
        }else{
            $branch_id=$this->session->userdata('companyId');
            $data['branch_id']=$branch_id;
        }
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*'); 
        $data['branch_info'] = $this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
        if($user_type==3 || $user_type==1){
            $data['branches'] =$this->m_common->get_row_array('department','','*');
        }else{
            $data['branches'] =$this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
        }
//        $branch_id = $this->session->userdata('companyId');
//        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        //$where = "so.unit_id=$branch_id";
        $where = "dc.status='Approved'";
        if($user_type==3 || $user_type==1){
            if(!empty($b_id)){
                $where .= " and so.unit_id=$b_id";
            }
        }else{
            $where .= " and so.unit_id=$branch_id";
        }
        $postData = $this->input->post();
        if (!empty($postData)) {

            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $category_id = $this->input->post('category_id');
//           if(!empty($customer_id)){
//               $data['customer_id']=$customer_id;
//                if(empty($where)){
//                    $where.="so.customer_id=$customer_id";
//                }else{
//                    $where.=" and so.customer_id=$customer_id";
//                }
//           }


            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "so.customer_id=$customer_id";
                } else {
                    $where .= " and so.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }



            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    $where .= "so.project_id=$project_id";
                } else {
                    $where .= " and so.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "do.o_id=$order_id";
                } else {
                    $where .= " and do.o_id=$order_id";
                }
            }

            if (!empty($product_id)) {
                $data['product_id'] = $product_id;
                if (empty($where)) {
                    $where .= "p.product_id=$product_id";
                } else {
                    $where .= " and p.product_id=$product_id";
                }
            }
            
            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "p.category_id=$category_id";
                } else {
                    $where .= " and p.category_id=$category_id";
                }
            }

            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $to_date = date('t-m-Y');
            }


            if(!empty($f_date) & !empty($to_date)){
                $sql = "select dcd.*,sum(dcd.quantity) as total_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dcd.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' GROUP BY so.project_id,dc.delivery_challan_date,p.product_name order by dc.delivery_challan_date DESC,so.customer_id desc";
            } else if (!empty($f_date)) {
                $sql = "select dcd.*,sum(dcd.quantity) as total_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dcd.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' GROUP BY so.project_id,dc.delivery_challan_date,p.product_name order by dc.delivery_challan_date DESC,so.customer_id desc";
            } else if (!empty($to_date)) {
                $sql = "select dcd.*,sum(dcd.quantity) as total_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dcd.is_active=1 and dc.delivery_challan_date<='" . $too_date . "' GROUP BY so.project_id,dc.delivery_challan_date,p.product_name order by dc.delivery_challan_date DESC,so.customer_id desc";
            } else {
                $sql = "select dcd.*,sum(dcd.quantity) as total_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dcd.is_active=1 GROUP BY so.project_id,dc.delivery_challan_date,p.product_name order by dc.delivery_challan_date DESC,so.customer_id desc";
            }
            $data['challans'] = $this->m_common->customeQuery($sql);
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $to_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';
            $data['category_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            if (!empty($f_date) & !empty($to_date)) {
                $sql = "select dcd.*,sum(dcd.quantity) as total_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dcd.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' GROUP BY so.project_id,dc.delivery_challan_date,p.product_name order by dc.delivery_challan_date DESC,so.customer_id desc";
            } else if (!empty($f_date)) {
                $sql = "select dcd.*,sum(dcd.quantity) as total_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dcd.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' GROUP BY so.project_id,dc.delivery_challan_date,p.product_name order by dc.delivery_challan_date DESC,so.customer_id desc";
            } else if (!empty($to_date)) {
                $sql = "select dcd.*,sum(dcd.quantity) as total_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dcd.is_active=1 and dc.delivery_challan_date<='" . $too_date . "' GROUP BY so.project_id,dc.delivery_challan_date,p.product_name order by dc.delivery_challan_date DESC,so.customer_id desc";
            } else {
                $sql = "select dcd.*,sum(dcd.quantity) as total_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dcd.is_active=1 GROUP BY so.project_id,dc.delivery_challan_date,p.product_name order by dc.delivery_challan_date DESC,so.customer_id desc";
            }

            $data['challans'] = $this->m_common->customeQuery($sql);
        }

       // $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*');
        
        if($print == false){
            $this->load->view('sales_report/v_customer_delivery_challan', $data);
        } else {
            $html = $this->load->view('sales_report/print_customer_delivery_challan', $data, true);
            echo $html;
            exit;
        }
    }

    function customerwiseChallanExcel($print = false) {
        $this->load->library("PHPExcel");
        $user_type = $this->session->userdata('user_type');
        
        $b_id=$this->input->post('branch_id');
        if($user_type==3 || $user_type==1){
            if(!empty($b_id)){
                $branch_id =$b_id; 
            }else{
                $branch_id='';
            }
            $data['branch_id']=$b_id;
        }else{
            $branch_id=$this->session->userdata('companyId');
            $data['branch_id']=$branch_id;
        }
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*'); 
        $data['branch_info'] = $this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
        if($user_type==3 || $user_type==1){
            $data['branches'] =$this->m_common->get_row_array('department','','*');
        }else{
            $data['branches'] =$this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
        }

        $where = '';
        //$where = "so.unit_id=$branch_id";
        $where = "dc.status='Approved'";
        if($user_type==3 || $user_type==1){
            if(!empty($b_id)){
                $where .= " and so.unit_id=$b_id";
            }
        }else{
            $where .= " and so.unit_id=$branch_id";
        }
        $postData = $this->input->post();
        if (!empty($postData)) {

            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $category_id = $this->input->post('category_id');
//           if(!empty($customer_id)){
//               $data['customer_id']=$customer_id;
//                if(empty($where)){
//                    $where.="so.customer_id=$customer_id";
//                }else{
//                    $where.=" and so.customer_id=$customer_id";
//                }
//           }


            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "so.customer_id=$customer_id";
                } else {
                    $where .= " and so.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }



            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    $where .= "so.project_id=$project_id";
                } else {
                    $where .= " and so.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "do.o_id=$order_id";
                } else {
                    $where .= " and do.o_id=$order_id";
                }
            }

            if (!empty($product_id)) {
                $data['product_id'] = $product_id;
                if (empty($where)) {
                    $where .= "p.product_id=$product_id";
                } else {
                    $where .= " and p.product_id=$product_id";
                }
            }
            
            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "p.category_id=$category_id";
                } else {
                    $where .= " and p.category_id=$category_id";
                }
            }

            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $to_date = date('t-m-Y');
            }


            if(!empty($f_date) & !empty($to_date)){
                $sql = "select dcd.*,sum(dcd.quantity) as total_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dcd.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' GROUP BY so.project_id,dc.delivery_challan_date,p.product_name order by dc.delivery_challan_date DESC,so.customer_id desc";
            } else if (!empty($f_date)) {
                $sql = "select dcd.*,sum(dcd.quantity) as total_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dcd.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' GROUP BY so.project_id,dc.delivery_challan_date,p.product_name order by dc.delivery_challan_date DESC,so.customer_id desc";
            } else if (!empty($to_date)) {
                $sql = "select dcd.*,sum(dcd.quantity) as total_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dcd.is_active=1 and dc.delivery_challan_date<='" . $too_date . "' GROUP BY so.project_id,dc.delivery_challan_date,p.product_name order by dc.delivery_challan_date DESC,so.customer_id desc";
            } else {
                $sql = "select dcd.*,sum(dcd.quantity) as total_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dcd.is_active=1 GROUP BY so.project_id,dc.delivery_challan_date,p.product_name order by dc.delivery_challan_date DESC,so.customer_id desc";
            }
            $data['challans'] = $this->m_common->customeQuery($sql);
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $to_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';
            $data['category_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            if (!empty($f_date) & !empty($to_date)) {
                $sql = "select dcd.*,sum(dcd.quantity) as total_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dcd.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' and dc.delivery_challan_date<='" . $too_date . "' GROUP BY so.project_id,dc.delivery_challan_date,p.product_name order by dc.delivery_challan_date DESC,so.customer_id desc";
            } else if (!empty($f_date)) {
                $sql = "select dcd.*,sum(dcd.quantity) as total_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dcd.is_active=1 and dc.delivery_challan_date>='" . $from_date . "' GROUP BY so.project_id,dc.delivery_challan_date,p.product_name order by dc.delivery_challan_date DESC,so.customer_id desc";
            } else if (!empty($to_date)) {
                $sql = "select dcd.*,sum(dcd.quantity) as total_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dcd.is_active=1 and dc.delivery_challan_date<='" . $too_date . "' GROUP BY so.project_id,dc.delivery_challan_date,p.product_name order by dc.delivery_challan_date DESC,so.customer_id desc";
            } else {
                $sql = "select dcd.*,sum(dcd.quantity) as total_qty,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,tpc.category_name,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_product_categories tpc on p.category_id=tpc.category_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dcd.is_active=1 GROUP BY so.project_id,dc.delivery_challan_date,p.product_name order by dc.delivery_challan_date DESC,so.customer_id desc";
            }

            $data['challans'] = $this->m_common->customeQuery($sql);
        }

        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        
        if(!empty($data['branch_info'])){
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        }else{
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2,"All Branch");
        }
        
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Customer Wise Delivery Challan');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:N3')->applyFromArray($style);

        $table_columns = array("SL", "C. Date.", "C.Name", "Project","P.Type", "P.Name", "M. Unit", "Quantity", "CUM Qty","Unit Price","Value");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:P5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:P5')->getFont()->setBold(true);


        $excel_row = 6;
        if (!empty($data['challans'])) {
            $total = 0;
            $i = 0;
            $totalcum = 0;
            $total_value=0;
            foreach ($data['challans'] as $key => $challan) {
                $i++;
                if ($order['product_name'] != 'Grouting'){
                    $total=$total+$challan['total_qty'];
                    $total_value = $total_value +$challan['unit_price']*$challan['total_qty'];
                    if ($challan['measurement_unit'] == 'CFT')
                        $totalcum = $totalcum + $challan['total_qty'] / 35.31;
                    else if ($challan['measurement_unit'] == 'MT')
                        $totalcum = $totalcum + $challan['total_qty'] / 2.41;
                    else
                        $totalcum = $totalcum + $challan['total_qty'];
                }

                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y', strtotime($challan['delivery_challan_date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $challan['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $challan['project_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $challan['category_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $challan['product_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $challan['measurement_unit']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, round($challan['total_qty'], 2));

                if ($challan['measurement_unit']=='CFT')
                    if (!empty($challan['quantity']))
                        $qty = round($challan['total_qty'] / 35.31, 2);

                    else if ($challan['measurement_unit']=='MT')
                        if (!empty($challan['total_qty']))
                            $qty = round($challan['total_qty'] / 2.41, 2);

                        else
                        if (!empty($challan['total_qty']))
                            $qty = round($challan['total_qty'], 2);

                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $qty);
                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, round($challan['unit_price'], 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, round(($challan['unit_price']*$challan['total_qty']), 2));
                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row,'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row,round($total, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row,round($totalcum, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row,'');
        $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row,round($total_value, 2));

        $object->getActiveSheet()->getStyle("K$excel_row:P$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("K$excel_row:P$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:P' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('M6:P'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'P'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="report.xls"');
        $object_writer->save('php://output');
    }

    function salesOrderNotExecuted($print = false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $branch_id = $this->session->userdata('companyId');
        $where = '';
        $where = "so.unit_id=$branch_id";
        $postData = $this->input->post();
        if (!empty($postData)) {


            $customer_id = $this->input->post('customer_id');
            if (!empty($customer_id)) {
                if (empty($where)) {
                    $where .= "sq.customer_id=$customer_id";
                } else {
                    $where .= " and sq.customer_id=$customer_id";
                }
            }
            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = '';
                $data['to_date'] = '';
            }


            if (!empty($f_date) & !empty($to_date)) {
                $sql = "select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where " . $where . " and so.is_active=1 and so.status='Pending' and sale_order_date>='" . $from_date . "' and sale_order_date<='" . $too_date." order by so.sale_order_date DESC";
            } else if (!empty($f_date)) {
                $sql = "select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where " . $where . " and so.is_active=1 and so.status='Pending' and sale_order_date>='" . $from_date." order by so.sale_order_date DESC";
            } else if (!empty($to_date)) {
                $sql = "select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where " . $where . " and so.is_active=1 and so.status='Pending' and sale_order_date<='" . $too_date." order by so.sale_order_date DESC";
            } else {
                $sql = "select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where " . $where . " and so.is_active=1 and so.status='Pending' order by so.sale_order_date DESC ";
            }
            $data['orders'] = $this->m_common->customeQuery($sql);
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = '';
            $data['to_date'] = '';
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            $sql = "select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where $where and so.is_active=1 and so.status='Pending' order by so.sale_order_date DESC ";
            $data['orders'] = $this->m_common->customeQuery($sql);
        }

        if ($print == false) {
            $this->load->view('sales_report/v_not_executed_sales_orders', $data);
        } else {
            $html = $this->load->view('sales_report/print_not_executed_sales_orders', $data, true);
            echo $html;
            exit;
        }
    }

    function salesOrderNotExecutedExcel($print = false) {
        $this->load->library("PHPExcel");
        $branch_id = $this->session->userdata('companyId');
        $where = '';
        $where = "so.unit_id=$branch_id";
        $postData = $this->input->post();
        if (!empty($postData)) {


            $customer_id = $this->input->post('customer_id');
            if (!empty($customer_id)) {
                if (empty($where)) {
                    $where .= "sq.customer_id=$customer_id";
                } else {
                    $where .= " and sq.customer_id=$customer_id";
                }
            }
            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = '';
                $data['to_date'] = '';
            }


            if (!empty($f_date) & !empty($to_date)) {
                $sql = "select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where " . $where . " and so.is_active=1 and so.status='Pending' and sale_order_date>='" . $from_date . "' and sale_order_date<='" . $too_date." order by so.sale_order_date DESC";
            } else if (!empty($f_date)) {
                $sql = "select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where " . $where . " and so.is_active=1 and so.status='Pending' and sale_order_date>='" . $from_date." order by so.sale_order_date DESC";
            } else if (!empty($to_date)) {
                $sql = "select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where " . $where . " and so.is_active=1 and so.status='Pending' and sale_order_date<='" . $too_date." order by so.sale_order_date DESC";
            } else {
                $sql = "select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where " . $where . " and so.is_active=1 and so.status='Pending' order by so.sale_order_date DESC ";
            }
            $data['orders'] = $this->m_common->customeQuery($sql);
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = '';
            $data['to_date'] = '';
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            $sql = "select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where $where and so.is_active=1 and so.status='Pending' order by so.sale_order_date DESC ";
            $data['orders'] = $this->m_common->customeQuery($sql);
        }

        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Not Executed Sales Orders');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:K3')->applyFromArray($style);

        $table_columns = array("SL", "Date", "S. Order No.", "Customer Name", "Project", "Value");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:K5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:K5')->getFont()->setBold(true);


        $excel_row = 6;


        if (!empty($data['orders'])) {
            $total = 0;
            $i = 0;
            foreach ($data['orders'] as $order) {
                $i++;
                $total = $total + $order['total_amount'];
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y', strtotime($order['sale_order_date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $order['order_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $order['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $order['project_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, round($order['total_amount'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, 'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, round($total, 2));

        $object->getActiveSheet()->getStyle("L$excel_row:K$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("L$excel_row:K$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:K' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('K6:K'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'K'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="report.xls"');
        $object_writer->save('php://output');
    }

    function receivableSalesOrdersBeforeDelivery($print = false) {
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $sql = "select so.*,c.c_name,c_short_name,pc.b_cash_amount,pc.b_bg_amount,pc.b_pdc_amount,pc.b_lc_amount from tbl_sales_orders so left join tbl_sales_order_payment_condition pc on so.o_id=pc.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where so.is_active=1 and (so.receive_status='Pending' or so.receive_status='Partial Received') order by so.sale_order_date DESC";
        $data['orders'] = $this->m_common->customeQuery($sql);
        foreach ($data['orders'] as $key => $order) {
            $b_total_amount = $order['b_cash_amount'] + $order['b_bg_amount'] + $order['b_pdc_amount'] + $order['b_lc_amount'];
            if ($b_total_amount > 0) {
                $c_sql = "select sum(amount) as total_amount from tbl_payment_collections where payment_status='Received' and o_id=" . $order['o_id'];
                $total = $this->m_common->customeQuery($c_sql);
                if (!empty($total)) {
                    if ($total[0]['total_amount'] < $b_total_amount) {
                        $data['orders'][$key]['receivable_amount'] = $b_total_amount - $total[0]['total_amount'];
                    } else {
                        unset($data['orders'][$key]);
                    }
                } else {
                    $data['orders'][$key]['receivable_amount'] = $b_total_amount;
                }
            } else {
                unset($data['orders'][$key]);
            }
        }
        if ($print == false) {
            $this->load->view('sales_report/v_receivable_before_delivery', $data);
        } else {
            $html = $this->load->view('sales_report/print_receivable_before_delivery', $data, true);
            echo $html;
            exit;
        }
    }

    function receivableSalesOrdersBeforeDeliveryExcel($print = false) {
        $this->load->library("PHPExcel");
        $sql = "select so.*,c.c_name,c_short_name,pc.b_cash_amount,pc.b_bg_amount,pc.b_pdc_amount,pc.b_lc_amount from tbl_sales_orders so left join tbl_sales_order_payment_condition pc on so.o_id=pc.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where so.is_active=1 and (so.receive_status='Pending' or so.receive_status='Partial Received') order by so.sale_order_date DESC";
        $data['orders'] = $this->m_common->customeQuery($sql);
        foreach ($data['orders'] as $key => $order) {
            $b_total_amount = $order['b_cash_amount'] + $order['b_bg_amount'] + $order['b_pdc_amount'] + $order['b_lc_amount'];
            if ($b_total_amount > 0) {
                $c_sql = "select sum(amount) as total_amount from tbl_payment_collections where payment_status='Received' and o_id=" . $order['o_id'];
                $total = $this->m_common->customeQuery($c_sql);
                if (!empty($total)) {
                    if ($total[0]['total_amount'] < $b_total_amount) {
                        $data['orders'][$key]['receivable_amount'] = $b_total_amount - $total[0]['total_amount'];
                    } else {
                        unset($data['orders'][$key]);
                    }
                } else {
                    $data['orders'][$key]['receivable_amount'] = $b_total_amount;
                }
            } else {
                unset($data['orders'][$key]);
            }
        }

        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Receivable Before Delivery');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:K3')->applyFromArray($style);

        $table_columns = array("SL", "Date", "S. Order No.", "Customer Name", "Project", "Value");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:K5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:K5')->getFont()->setBold(true);


        $excel_row = 6;


        if (!empty($data['orders'])) {
            $total = 0;
            $t_received = 0;
            $t_due = 0;
            $i = 0;
            foreach ($data['orders'] as $order) {
                $i++;
                $total = $total + $order['receivable_amount'];
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y', strtotime($order['sale_order_date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $order['order_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $order['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $order['project_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, round($order['total_amount'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, 'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, round($total, 2));

        $object->getActiveSheet()->getStyle("J$excel_row:K$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("J$excel_row:K$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:K' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('K6:K'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'K'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="report.xls"');
        $object_writer->save('php://output');
    }

    function receivableSalesOrders($print = false) {
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $sql = "select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where so.is_active=1 and (so.receive_status='Pending' or so.receive_status='Partial Received') order by so.sale_order_date DESC";
        $data['orders'] = $this->m_common->customeQuery($sql);
        foreach ($data['orders'] as $key => $order) {
            $c_sql = "select sum(amount) as total_amount from tbl_payment_collections where payment_status='Received' and o_id=" . $order['o_id'];
            $total = $this->m_common->customeQuery($c_sql);
            if (!empty($total)) {
                $data['orders'][$key]['received_amount'] = $total[0]['total_amount'];
                $data['orders'][$key]['due_amount'] = $order['total_amount'] - $total[0]['total_amount'];
            } else {
                $data['orders'][$key]['received_amount'] = '';
                $data['orders'][$key]['due_amount'] = $order['total_amount'];
            }
        }
        if ($print == false) {
            $this->load->view('sales_report/v_receivable_orders', $data);
        } else {
            $html = $this->load->view('sales_report/print_receivable_orders', $data, true);
            echo $html;
            exit;
        }
    }

   

    function receivableSalesOrdersExcel($print = false) {
        $this->load->library("PHPExcel");
        $sql = "select so.*,c.c_name,c_short_name from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where so.is_active=1 and (so.receive_status='Pending' or so.receive_status='Partial Received') order by so.sale_order_date DESC";
        $data['orders'] = $this->m_common->customeQuery($sql);
        foreach ($data['orders'] as $key => $order) {
            $c_sql = "select sum(amount) as total_amount from tbl_payment_collections where payment_status='Received' and o_id=" . $order['o_id'];
            $total = $this->m_common->customeQuery($c_sql);
            if (!empty($total)) {
                $data['orders'][$key]['received_amount'] = $total[0]['total_amount'];
                $data['orders'][$key]['due_amount'] = $order['total_amount'] - $total[0]['total_amount'];
            } else {
                $data['orders'][$key]['received_amount'] = '';
                $data['orders'][$key]['due_amount'] = $order['total_amount'];
            }
        }

        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Receivable Before Delivery');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:M3')->applyFromArray($style);

        $table_columns = array("SL", "Date", "S. Order No.", "Customer Name", "Project", "Value", "Received", "Due");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:M5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:M5')->getFont()->setBold(true);


        $excel_row = 6;


        if (!empty($data['orders'])) {
            $total = 0;
            $t_received = 0;
            $t_due = 0;
            $i = 0;
            foreach ($data['orders'] as $order) {
                $i++;
                $total = $total + $order['total_amount'];
                $t_received = $t_received + $order['received_amount'];
                $t_due = $t_due + $order['due_amount'];
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y', strtotime($order['sale_order_date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $order['order_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $order['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $order['project_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, round($order['total_amount'], 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, round($order['received_amount'], 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, round($order['due_amount'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, 'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, round($total, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, round($t_received, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, round($t_due, 2));
        $object->getActiveSheet()->getStyle("J$excel_row:M$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("J$excel_row:M$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:M' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('K6:M'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'M'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="report.xls"');
        $object_writer->save('php://output');
    }

    function agingReport($print = false) {
        $this->menu ='sales';
        $this->sub_inner_menu ='sales_report';
        $this->titlebackend("Report");


        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
    //    $where = "inv.unit_id=$branch_id";
        $postData = $this->input->post();
        if (!empty($postData)) {

           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $customer_id=$this->input->post('customer_id');
           $project_id=$this->input->post('project_id');
           $category_id=$this->input->post('category_id');
            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                   // $where .= "so.customer_id=$customer_id";
                    $where .= "inv.customer_id=$customer_id";
                } else {
                   // $where .= " and so.customer_id=$customer_id";
                    $where .= " and inv.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }



            if(!empty($project_id)){
                $data['project_id']=$project_id;
                if(empty($where)){
                    $where .= "inv.project_id=$project_id";
                } else {
                    $where .= " and inv.project_id=$project_id";
                }
            }else{
                $data['project_id'] = '';
            }
            
            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "inv.category_id=$category_id";
                } else {
                    $where .= " and inv.category_id=$category_id";
                }
            } else {
                $data['category_id'] = '';
            }

            if(!empty($f_date)){                
                $data['f_date'] = $f_date;
            } else {                
                $data['f_date'] = $f_date;
            }
            
            if(!empty($to_date)){                
                $data['to_date'] = $to_date;
            } else {                
                $data['to_date'] = $to_date;
            }
           
           // $sql = "select inv.*,c.c_name,c_short_name,tpc.category_name from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.is_active=1 and (inv.status='Pending' or inv.status='Partial Received') and ".$where." order by inv.sale_invoice_date";
            $sql = "select inv.*,c.c_name,c_short_name,tpc.category_name,tp.project_name as tp_project_name from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id left join tbl_project tp on inv.project_id=tp.project_id where inv.is_active=1 and inv.status!='Canceled' and (inv.status='Pending' or inv.status='Partial Received') and ".$where." order by inv.sale_invoice_date";
            $data['invoices'] = $this->m_common->customeQuery($sql);
        } else {
           // $sql = "select inv.*,c.c_name,c_short_name,tpc.category_name from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.is_active=1 and (inv.status='Pending' or inv.status='Partial Received') and ".$where." order by inv.sale_invoice_date";
            $sql = "select inv.*,c.c_name,c_short_name,tpc.category_name,tp.project_name as tp_project_name from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id left join tbl_project tp on inv.project_id=tp.project_id where inv.is_active=1 and inv.status!='Canceled' and (inv.status='Pending' or inv.status='Partial Received') order by inv.sale_invoice_date";
            $data['invoices'] = $this->m_common->customeQuery($sql);
        }
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*'); 
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        if($print == false){
            $this->load->view('sales_report/aging_report',$data);
        } else {
            $html = $this->load->view('sales_report/print_aging_report', $data, true);
            echo $html;
            exit;
        }
    }
    
    
    function agingReportExcell($print = false){
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");

        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
    //    $where = "inv.unit_id=$branch_id";
        $postData = $this->input->post();
        if (!empty($postData)) {

           $f_date = $this->input->post('from_date');
           $to_date = $this->input->post('to_date');
           $customer_id = $this->input->post('customer_id');
           $project_id = $this->input->post('project_id');
           $category_id = $this->input->post('category_id');
            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "inv.customer_id=$customer_id";
                } else {
                    $where .= " and inv.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }



            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    $where .= "inv.project_id=$project_id";
                } else {
                    $where .= " and inv.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "inv.category_id=$category_id";
                } else {
                    $where .= " and inv.category_id=$category_id";
                }
            } else {
                $data['category_id'] = '';
            }

//            if (!empty($f_date)) {
//                $from_date = date('Y-m-d', strtotime($f_date));
//                $data['f_date'] = $f_date;
//            } else {
//                $from_date = date('Y-m-d');
//                $data['f_date'] = $f_date;
//            }
//            if (!empty($to_date)) {
//                $too_date = date('Y-m-d', strtotime($to_date));
//                $data['to_date'] = $to_date;
//            } else {
//                $too_date = date('Y-m-d');
//                $data['to_date'] = $to_date;
//            }
//            
            //$sql = "select inv.*,c.c_name,c_short_name,tpc.category_name from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.is_active=1 and (inv.status='Pending' or inv.status='Partial Received') and ".$where." order by inv.sale_invoice_date";
            $sql = "select inv.*,c.c_name,c_short_name,tpc.category_name,tp.project_name as tp_project_name from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id left join tbl_project tp on inv.project_id=tp.project_id where inv.is_active=1 and inv.status!='Canceled' and (inv.status='Pending' or inv.status='Partial Received') and ".$where." order by inv.sale_invoice_date";
            $data['invoices'] = $this->m_common->customeQuery($sql);
        } else {
            //$sql = "select inv.*,c.c_name,c_short_name,tpc.category_name from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.is_active=1 and (inv.status='Pending' or inv.status='Partial Received') and ".$where." order by inv.sale_invoice_date";
            $sql = "select inv.*,c.c_name,c_short_name,tpc.category_name,tp.project_name as tp_project_name from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id left join tbl_project tp on inv.project_id=tp.project_id where inv.is_active=1 and inv.status!='Canceled' and (inv.status='Pending' or inv.status='Partial Received') order by inv.sale_invoice_date";
            $data['invoices'] = $this->m_common->customeQuery($sql);
        }
        
        
        $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Invoice Aging Report');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:M3')->applyFromArray($style);

        $table_columns = array("SL", "Date", "Invoice No.", "Customer Name", "Project","Product Type", "Value", "Received","Age Days","0-30 Days","31-60 Days","61-90 Days","90+ Days");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:R5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:R5')->getFont()->setBold(true);


        $excel_row = 6;


        if(!empty($data['invoices'])){
            $total = 0;
            $t_received = 0;
            $t_due = 0;
            $i = 0;
            $due_0 = 0;
            $due_30 = 0;
            $due_60 = 0;
            $due_90 = 0;
            foreach($data['invoices'] as $order){
                $i++;
                
                $dif_day = diff_day($order['sale_invoice_date']);
                if(!empty($f_date) && !empty($to_date)){
                    if (($dif_day >= $f_date) && ($dif_day <=$to_date)) {
                        $total = $total + $order['total_amount'];
                        $t_received = $t_received + $order['received_amount'];
                        $due = $order['total_amount']-$order['received_amount'];
                        $t_due = $t_due + $due;
                    }else{
                        continue;
                    }
                }else if(!empty($f_date)){
                    if ($dif_day >= $f_date){
                        $total = $total + $order['total_amount'];
                        $t_received = $t_received + $order['received_amount'];
                        $due = $order['total_amount']-$order['received_amount'];
                        $t_due = $t_due + $due;
                    }else{
                        continue;
                    }
                }else if(!empty($to_date)){
                    if ($dif_day <=$to_date) {
                        $total = $total + $order['total_amount'];
                        $t_received = $t_received + $order['received_amount'];
                        $due = $order['total_amount']-$order['received_amount'];
                        $t_due = $t_due + $due;
                    }else{
                        continue;
                    }
                }else{
                    $total = $total + $order['total_amount'];
                    $t_received = $t_received + $order['received_amount'];
                    $due = $order['total_amount']-$order['received_amount'];
                    $t_due = $t_due + $due;
                }
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y', strtotime($order['sale_invoice_date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $order['inv_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $order['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $order['tp_project_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $order['category_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, round($order['total_amount'], 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, round($order['received_amount'], 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $dif_day);
                if($dif_day>=0 and $dif_day<=30){
                    $due_0+=$due;
                    $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row,round($order['total_amount'], 2));
                }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row,'-');
                }
                if($dif_day>30 and $dif_day<=60){
                    $due_30+=$due;
                    $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row,round($order['total_amount'], 2));
                }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row,'-');
                } 
                if($dif_day>60 and $dif_day<=90){
                    $due_60+=$due;
                    $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row,round($order['total_amount'], 2));
                }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row,'-'); 
                } 
                if($dif_day>90){
                    $due_90+=$due;
                    $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row,round($order['total_amount'], 2));
                }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row,'-');
                }

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, 'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, round($total, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, round($t_received, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row,'');
        $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row,round($due_0, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row,round($due_30, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row,round($due_60, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row,round($due_90, 2));
        
        $object->getActiveSheet()->getStyle("J$excel_row:R$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("J$excel_row:R$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:R' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('L6:R'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'R'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="report.xls"');
        $object_writer->save('php://output');
        
    }
    
    
    function agingSummaryReport($print = false) {
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");


        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
    //    $where = "inv.unit_id=$branch_id";
        
        $f_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $category_id = $this->input->post('category_id');
        
        if (!empty($f_date)) {                
            $data['f_date'] = $f_date;
        } else {                
            $data['f_date'] = $f_date;
        }

        if (!empty($to_date)) {                
            $data['to_date'] = $to_date;
        } else {                
            $data['to_date'] = $to_date;
        }
        if (!empty($category_id)) {
            $data['category_id'] = $category_id;
                
        } else {
            $data['category_id'] = '';
        }
        
        $postData = $this->input->post();
        if(!empty($postData)){
            $customer_id = $this->input->post('customer_id');
            $data['customer_id']=$customer_id;
            if(!empty($customer_id)){
                $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1,'id'=>$customer_id), '*', '', '', 'c_name');
            }else{
                $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            }
        } else {
            $data['customer_id'] = '';
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        }
        
        foreach($data['customers'] as $key=>$value){
            if(empty($category_id)){
               // $sql = "select inv.*,c.c_name,c_short_name,tpc.category_name from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.is_active=1 and (inv.status='Pending' or inv.status='Partial Received') and so.customer_id=".$value['id']." order by inv.sale_invoice_date";
                  $sql = "select inv.*,c.c_name,c_short_name,tpc.category_name from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.is_active=1 and inv.status!='Canceled' and (inv.status='Pending' or inv.status='Partial Received') and inv.customer_id=".$value['id']." order by inv.sale_invoice_date";
            }else{
                //$sql = "select inv.*,c.c_name,c_short_name,tpc.category_name from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.is_active=1 and (inv.status='Pending' or inv.status='Partial Received') and so.customer_id=".$value['id']." and inv.category_id=$category_id order by inv.sale_invoice_date";
                 $sql = "select inv.*,c.c_name,c_short_name,tpc.category_name from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.is_active=1 and inv.status!='Canceled' and (inv.status='Pending' or inv.status='Partial Received') and inv.customer_id=".$value['id']." and inv.category_id=$category_id order by inv.sale_invoice_date";
            }
            $data['customers'][$key]['invoices'] = $this->m_common->customeQuery($sql);
            if(empty($data['customers'][$key]['invoices'])){
                unset($data['customers'][$key]);
            }
        }
        $data['customers_info'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*'); 
        if ($print == false) {
            $this->load->view('sales_report/aging_summary_report', $data);
        } else {
            $html = $this->load->view('sales_report/print_aging_summary_report', $data, true);
            echo $html;
            exit;
        }
    }
    
    function agingSummaryReportExcell($print = false) {
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");


        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
    //    $where = "inv.unit_id=$branch_id";
        $f_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $category_id = $this->input->post('category_id');
        $postData = $this->input->post();
        if(!empty($postData)){
            $customer_id = $this->input->post('customer_id');
            $data['customer_id']=$customer_id;
            if(!empty($customer_id)){
                $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1,'id'=>$customer_id), '*', '', '', 'c_name');
            }else{
                $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            }
        } else {
            $data['customer_id'] = '';
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        }
        
        foreach($data['customers'] as $key=>$value){
            if(empty($category_id)){
                //$sql = "select inv.*,c.c_name,c_short_name,tpc.category_name from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.is_active=1 and (inv.status='Pending' or inv.status='Partial Received') and so.customer_id=".$value['id']." order by inv.sale_invoice_date";
                  $sql = "select inv.*,c.c_name,c_short_name,tpc.category_name from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.is_active=1 and inv.status!='Canceled' and (inv.status='Pending' or inv.status='Partial Received') and inv.customer_id=".$value['id']." order by inv.sale_invoice_date";
            }else{
               // $sql = "select inv.*,c.c_name,c_short_name,tpc.category_name from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.is_active=1 and (inv.status='Pending' or inv.status='Partial Received') and so.customer_id=".$value['id']." and inv.category_id=$category_id order by inv.sale_invoice_date";
                $sql = "select inv.*,c.c_name,c_short_name,tpc.category_name from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.is_active=1 and inv.status!='Canceled' and (inv.status='Pending' or inv.status='Partial Received') and inv.customer_id=".$value['id']." and inv.category_id=$category_id order by inv.sale_invoice_date";
            }
            $data['customers'][$key]['invoices'] = $this->m_common->customeQuery($sql);
            if(empty($data['customers'][$key]['invoices'])){
                unset($data['customers'][$key]);
            }
        }
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        

        
        
        $object->getActiveSheet()->getStyle('F1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      //  $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->SetCellValue('F1','Karim Asphalt & Ready Mix Ltd.' );
        $object->getActiveSheet()->mergeCells('F1:J1');
        
        $object->getActiveSheet()->getStyle('F2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('F2')->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle('F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
     //   $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);   
        $object->getActiveSheet()->SetCellValue('F2',$data['branch_info'][0]['dep_description'] );
        $object->getActiveSheet()->mergeCells('F2:J2');
        
        $object->getActiveSheet()->getStyle('F3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       // $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Invoice Aging Report');
        $object->getActiveSheet()->SetCellValue('F3','Invoice Aging Summary Report' );
        $object->getActiveSheet()->mergeCells('F3:J3');
        
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('F1:J3')->applyFromArray($style);

        $table_columns = array("SL","Customer Name","Invoice No.","Product Type","Value","Age Days");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:J5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:J5')->getFont()->setBold(true);


        $excel_row = 5;


        if(!empty($data['customers'])){
             $grand_total = 0;
             $i=0;
            foreach ($data['customers'] as $customer) {
                $excel_row++;
                $i++;
                $sub_total=0;
                $t_due=0;
                $total=0;
                $t_received=0;
                
                foreach($customer['invoices'] as $order){
//                    $grand_total = $grand_total + $order['total_amount'];
//                    $sub_total=$sub_total+$order['total_amount'];
                    $dif_day = diff_day($order['sale_invoice_date']);
                    
                    if(!empty($f_date) && !empty($to_date)){
                        if(($dif_day >= $f_date) && ($dif_day <=$to_date)){
                            $total = $total + $order['total_amount'];
                            $t_received = $t_received + $order['received_amount'];
                            $due = $order['total_amount']-$order['received_amount'];
                            $t_due = $t_due + $due;
                            $grand_total = $grand_total + $due;
                            $sub_total=$sub_total+$due;
                        }else{
                            continue;
                        }
                    }else if(!empty($f_date)){
                        if($dif_day >= $f_date){
                            $total = $total + $order['total_amount'];
                            $t_received = $t_received + $order['received_amount'];
                            $due = $order['total_amount']-$order['received_amount'];
                            $t_due = $t_due + $due;
                            $grand_total = $grand_total + $due;
                            $sub_total=$sub_total+$due;
                        }else{
                            continue;
                        }
                    }else if(!empty($to_date)){
                        if($dif_day <=$to_date){
                            $total = $total + $order['total_amount'];
                            $t_received = $t_received + $order['received_amount'];
                            $due = $order['total_amount']-$order['received_amount'];
                            $t_due = $t_due + $due;
                            $grand_total = $grand_total + $due;
                            $sub_total=$sub_total+$due;
                        }else{
                            continue;
                        }
                    }else{
                        $total = $total + $order['total_amount'];
                        $t_received = $t_received + $order['received_amount'];
                        $due = $order['total_amount']-$order['received_amount'];
                        $t_due = $t_due + $due;
                        $grand_total = $grand_total + $due;
                        $sub_total=$sub_total+$due;
                    }
                    
                    
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);                   
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $order['c_name']); 
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $order['inv_no']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $order['category_name']); 
                    $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, round($due, 2));                   
                    $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $dif_day);
                    $excel_row++;
                }
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row,'Sub Total');
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, round($sub_total,2));
                $object->getActiveSheet()->getStyle('H'.$excel_row)->getFont()->setBold(true);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row,'');

               
            }
            $excel_row++;
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, 'Grand Total');
       
        $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, round($grand_total, 2));
        $object->getActiveSheet()->getStyle('H'.$excel_row)->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row,'');
        
        
        $object->getActiveSheet()->getStyle("J$excel_row:Q$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("J$excel_row:Q$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:K' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('I6:I'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'K'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="invoice_aging_summary_report.xls"');
        $object_writer->save('php://output');
    }
    
    
    function customerAgingReport($print = false) {
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");        
        $postData = $this->input->post();
        if(!empty($postData['customer_id'])){
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' =>1,'id'=>$postData['customer_id']), '*', '', '', 'c_name');
        }else{
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' =>1), '*', '', '', 'c_name');
        }
        
        foreach($data['customers'] as $key=>$value){
            $invoices='';
            $where='';
            $where .= "inv.customer_id=".$value['id'];
            $sql = "select inv.* from tbl_sales_invoices inv where inv.is_active=1 and inv.status!='Canceled' and (inv.status='Pending' or inv.status='Partial Received') and ".$where." order by inv.sale_invoice_date";
            $invoices= $this->m_common->customeQuery($sql);
            $due_0_30 = 0;
            $due_31_60 = 0;
            $due_61_90 = 0;
            $due_91_up = 0;
            $net_due=0;
            foreach($invoices as $inv){
                $dif_day=diff_day($inv['sale_invoice_date']);
                $due =$inv['total_amount']-$inv['received_amount'];
                $net_due=$net_due+$due;
                if($dif_day>90){
                    $due_91_up=$due_91_up+$due;
                }else if (($dif_day >60) && ($dif_day <91)){
                    $due_61_90=$due_61_90+$due;
                }else if (($dif_day>30) && ($dif_day<61)) {
                    $due_31_60=$due_31_60+$due;
                }else if (($dif_day>=0) && ($dif_day <31)) {
                    $due_0_30=$due_0_30+$due;
                }
            }
            if($net_due==0){
                unset($data['customers'][$key]);
                continue;
            }
            $data['customers'][$key]['thirty']=$due_0_30;
            $data['customers'][$key]['sixty']=$due_31_60;
            $data['customers'][$key]['ninety']=$due_61_90;
            $data['customers'][$key]['ninety_up']=$due_91_up;            
            $data['customers'][$key]['net_total']=$net_due;
        }
        if($print == false){
            $this->load->view('sales_report/customer_aging_report',$data);
        }else{
            $html=$this->load->view('sales_report/print_customer_aging_report', $data, true);
            echo $html;
            exit;
        }
    }
    
    
    function customerAgingReportExcell($print = false){
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $postData = $this->input->post();
        if(!empty($postData['customer_id'])){
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' =>1,'id'=>$postData['customer_id']), '*', '', '', 'c_name');
        }else{
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' =>1), '*', '', '', 'c_name');
        }
        
        foreach($data['customers'] as $key=>$value){
            $invoices='';
            $where='';
            $where.="inv.customer_id=".$value['id'];
            $sql="select inv.* from tbl_sales_invoices inv where inv.is_active=1 and inv.status!='Canceled' and (inv.status='Pending' or inv.status='Partial Received') and ".$where." order by inv.sale_invoice_date";
            $invoices= $this->m_common->customeQuery($sql);
            $due_0_30 =0;
            $due_31_60 =0;
            $due_61_90 =0;
            $due_91_up =0;
            $net_due=0;
            foreach($invoices as $inv){
                $dif_day=diff_day($inv['sale_invoice_date']);
                $due =$inv['total_amount']-$inv['received_amount'];
                $net_due=$net_due+$due;
                if($dif_day>90){
                    $due_91_up=$due_91_up+$due;
                }else if (($dif_day >60) && ($dif_day <91)){
                    $due_61_90=$due_61_90+$due;
                }else if (($dif_day>30) && ($dif_day<61)) {
                    $due_31_60=$due_31_60+$due;
                }else if (($dif_day>=0) && ($dif_day <31)) {
                    $due_0_30=$due_0_30+$due;
                }
            }
            if($net_due==0){
                unset($data['customers'][$key]);
                continue;
            }
            $data['customers'][$key]['thirty']=$due_0_30;
            $data['customers'][$key]['sixty']=$due_31_60;
            $data['customers'][$key]['ninety']=$due_61_90;
            $data['customers'][$key]['ninety_up']=$due_91_up;            
            $data['customers'][$key]['net_total']=$net_due;
        }
        
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Customer Wise Aging Report');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:M3')->applyFromArray($style);

        $table_columns = array("SL","Customer Name","0-30 Days","31-60 Days","61-90 Days","90+ Days","Total");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:R5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:R5')->getFont()->setBold(true);


        $excel_row = 6;


        if(!empty($data['customers'])){
                $due_0=0;
                $due_30=0;
                $due_60=0;
                $due_90=0;
                $net_due_total=0;
                foreach ($data['customers'] as $cust) {
                    $i++;
                    $due_0=$due_0+$cust['thirty']; 
                    $due_30=$due_30+$cust['sixty'];
                    $due_60=$due_60+$cust['ninety'];
                    $due_90=$due_90+$cust['ninety_up'];
                    $net_due_total=$net_due_total+$cust['net_total'];
                $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row, $i);               
                $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row, $cust['c_name']);                
                $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row, round($cust['thirty'],2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row, round($cust['sixty'],2));                               
                $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,round($cust['ninety'],2));                               
                $object->getActiveSheet()->setCellValueByColumnAndRow(10,$excel_row,round($cust['ninety_up'],2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(11,$excel_row,round($cust['net_total'],2));
                 
                

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row,'G.Total');        
        $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row,round($due_0,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,round($due_30,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,round($due_60,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(10,$excel_row,round($due_90,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(11,$excel_row,round($net_due_total,2));
        
        $object->getActiveSheet()->getStyle("G$excel_row:L$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("G$excel_row:L$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:L' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('G6:L'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'R'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer=PHPExcel_IOFactory::createWriter($object,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="customer_aging_report.xls"');
        $object_writer->save('php://output');
        
    }
    
    
     function unsecuredCustomer($print = false) {
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");        
        $postData = $this->input->post();
        if(!empty($postData['customer_id'])){
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' =>1,'id'=>$postData['customer_id']), '*', '', '', 'c_name');
        }else{
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' =>1), '*', '', '', 'c_name');
        }
        
        foreach($data['customers'] as $key=>$value){
            
            $hand_sql = "select sum(pc.amount) as total_amount from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.is_active=1 and (pc.payment_status='Collected' || pc.payment_status='Deposited' || pc.payment_status='Dishonored') and pc.customer_id=".$value['id'];
            $in_hand=$this->m_common->customeQuery($hand_sql);
            
            $hand_sql = "select sum(pc.amount) as total_amount from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.collection_method='Bg' and pc.is_active=1 and (pc.payment_status='Collected' || pc.payment_status='Deposited' || pc.payment_status='Dishonored') and pc.customer_id=".$value['id'];
            $bg_in_hand=$this->m_common->customeQuery($hand_sql);
            
            $invoices='';
            $where='';
            $where .= "inv.customer_id=".$value['id'];
            $sql = "select inv.* from tbl_sales_invoices inv where inv.is_active=1 and inv.status!='Canceled' and (inv.status='Pending' or inv.status='Partial Received') and ".$where." order by inv.sale_invoice_date";
            $invoices= $this->m_common->customeQuery($sql);
            $due_0_30 = 0;
            $due_31_60 = 0;
            $due_61_90 = 0;
            $due_91_up = 0;
            $net_due=0;
            foreach($invoices as $inv){
                $dif_day=diff_day($inv['sale_invoice_date']);
                $due =$inv['total_amount']-$inv['received_amount'];
                $net_due=$net_due+$due;
                if($dif_day>90){
                    $due_91_up=$due_91_up+$due;
                }else if (($dif_day >60) && ($dif_day <91)){
                    $due_61_90=$due_61_90+$due;
                }else if (($dif_day>30) && ($dif_day<61)) {
                    $due_31_60=$due_31_60+$due;
                }else if (($dif_day>=0) && ($dif_day <31)) {
                    $due_0_30=$due_0_30+$due;
                }
            }
            if($net_due==0){
                unset($data['customers'][$key]);
                continue;
            }
            
            $data['customers'][$key]['thirty']=$due_0_30;
            $data['customers'][$key]['sixty']=$due_31_60;
            $data['customers'][$key]['ninety']=$due_61_90;
            $data['customers'][$key]['ninety_up']=$due_91_up;            
            $data['customers'][$key]['net_total']=$net_due;
            $data['customers'][$key]['total_in_hand']=$in_hand[0]['total_amount'];
            $data['customers'][$key]['pdc_lc_in_hand']=$in_hand[0]['total_amount']-$bg_in_hand[0]['total_amount'];
            $data['customers'][$key]['bg_in_hand']=$bg_in_hand[0]['total_amount'];
            $unsecure_amount=$net_due-$in_hand[0]['total_amount'];
            if($unsecure_amount>0){
              $data['customers'][$key]['unsecure_amount']=$unsecure_amount;  
            }else{
              unset($data['customers'][$key]);  
            }
        }
        if($print==false){
            $this->load->view('sales_report/unsecured_customer',$data);
        }else{
            $html=$this->load->view('sales_report/print_unsecured_customer', $data, true);
            echo $html;
            exit;
        }
    }
    
    
    function unsecuredCustomerExcell($print = false){
        $this->menu='sales';
        $this->sub_inner_menu='sales_report';
        $this->titlebackend("Report");
        $postData = $this->input->post();
        if(!empty($postData['customer_id'])){
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' =>1,'id'=>$postData['customer_id']), '*', '', '', 'c_name');
        }else{
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' =>1), '*', '', '', 'c_name');
        }
        
        foreach($data['customers'] as $key=>$value){
            
            $hand_sql = "select sum(pc.amount) as total_amount from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.is_active=1 and (pc.payment_status='Collected' || pc.payment_status='Deposited' || pc.payment_status='Dishonored') and pc.customer_id=".$value['id'];
            $in_hand=$this->m_common->customeQuery($hand_sql);
            
            $hand_sql = "select sum(pc.amount) as total_amount from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.collection_method='Bg' and pc.is_active=1 and (pc.payment_status='Collected' || pc.payment_status='Deposited' || pc.payment_status='Dishonored') and pc.customer_id=".$value['id'];
            $bg_in_hand=$this->m_common->customeQuery($hand_sql);
            
            $invoices='';
            $where='';
            $where .= "inv.customer_id=".$value['id'];
            $sql = "select inv.* from tbl_sales_invoices inv where inv.is_active=1 and inv.status!='Canceled' and (inv.status='Pending' or inv.status='Partial Received') and ".$where." order by inv.sale_invoice_date";
            $invoices= $this->m_common->customeQuery($sql);
            $due_0_30 = 0;
            $due_31_60 = 0;
            $due_61_90 = 0;
            $due_91_up = 0;
            $net_due=0;
            foreach($invoices as $inv){
                $dif_day=diff_day($inv['sale_invoice_date']);
                $due =$inv['total_amount']-$inv['received_amount'];
                $net_due=$net_due+$due;
                if($dif_day>90){
                    $due_91_up=$due_91_up+$due;
                }else if (($dif_day >60) && ($dif_day <91)){
                    $due_61_90=$due_61_90+$due;
                }else if (($dif_day>30) && ($dif_day<61)) {
                    $due_31_60=$due_31_60+$due;
                }else if (($dif_day>=0) && ($dif_day <31)) {
                    $due_0_30=$due_0_30+$due;
                }
            }
            if($net_due==0){
                unset($data['customers'][$key]);
                continue;
            }
            
            $data['customers'][$key]['thirty']=$due_0_30;
            $data['customers'][$key]['sixty']=$due_31_60;
            $data['customers'][$key]['ninety']=$due_61_90;
            $data['customers'][$key]['ninety_up']=$due_91_up;            
            $data['customers'][$key]['net_total']=$net_due;
            $data['customers'][$key]['total_in_hand']=$in_hand[0]['total_amount'];
            $data['customers'][$key]['pdc_lc_in_hand']=$in_hand[0]['total_amount']-$bg_in_hand[0]['total_amount'];
            $data['customers'][$key]['bg_in_hand']=$bg_in_hand[0]['total_amount'];
            $unsecure_amount=$net_due-$in_hand[0]['total_amount'];
            if($unsecure_amount>0){
              $data['customers'][$key]['unsecure_amount']=$unsecure_amount;  
            }else{
              unset($data['customers'][$key]);  
            }
        }
        
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Customer Wise Aging Report');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:M3')->applyFromArray($style);

        $table_columns = array("SL","Customer Name","0-30 Days","31-60 Days","61-90 Days","90+ Days","Total Due","Lc/Pdc/Cheque at hand","Bg at hand","Total at hand","Unsecured Amount");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:R5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:R5')->getFont()->setBold(true);


        $excel_row = 6;


        if(!empty($data['customers'])){
                $due_0=0;
                $due_30=0;
                $due_60=0;
                $due_90=0;
                $net_due_total=0;
                $net_total_in_hand=0;
                $net_total_lc_in_hand=0;
                $net_total_bg_in_hand=0;
                $net_total_unsecured=0;
                
            foreach ($data['customers'] as $cust) {
                    $i++;
                    $due_0=$due_0+$cust['thirty']; 
                    $due_30=$due_30+$cust['sixty'];
                    $due_60=$due_60+$cust['ninety'];
                    $due_90=$due_90+$cust['ninety_up'];
                    $net_due_total=$net_due_total+$cust['net_total'];
                    $net_total_in_hand=$net_total_in_hand+$cust['total_in_hand'];
                    $net_total_lc_in_hand=$net_total_lc_in_hand+$cust['pdc_lc_in_hand'];
                    $net_total_bg_in_hand=$net_total_bg_in_hand+$cust['bg_in_hand'];
                    $net_total_unsecured=$net_total_unsecured+$cust['unsecure_amount'];
                $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row, $i);               
                $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row, $cust['c_name']);                
                $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row, round($cust['thirty'],2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row, round($cust['sixty'],2));                               
                $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,round($cust['ninety'],2));                               
                $object->getActiveSheet()->setCellValueByColumnAndRow(10,$excel_row,round($cust['ninety_up'],2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(11,$excel_row,round($cust['net_total'],2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(12,$excel_row,round($cust['pdc_lc_in_hand'],2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(13,$excel_row,round($cust['bg_in_hand'],2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(14,$excel_row,round($cust['total_in_hand'],2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(15,$excel_row,round($cust['unsecure_amount'],2));
                 
                

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row,'G.Total');        
        $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row,round($due_0,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,round($due_30,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,round($due_60,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(10,$excel_row,round($due_90,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(11,$excel_row,round($net_due_total,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(12,$excel_row,round($net_total_lc_in_hand,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(13,$excel_row,round($net_total_bg_in_hand,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(14,$excel_row,round($net_total_in_hand,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(15,$excel_row,round($net_total_unsecured,2));
        
        $object->getActiveSheet()->getStyle("G$excel_row:P$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("G$excel_row:P$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:P'.$excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('G6:P'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'R'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer=PHPExcel_IOFactory::createWriter($object,'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="customer_aging_report.xls"');
        $object_writer->save('php://output');
        
    }
    
    
    
    
    function receivableSummaryReport($print=false){
        $this->menu='sales';
        $this->sub_inner_menu='sales_report';
        $this->titlebackend("Report");


        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
    //    $where = "inv.unit_id=$branch_id";
        
        $f_date=$this->input->post('from_date');
        $to_date=$this->input->post('to_date');
        $customer_id=$this->input->post('customer_id');
        $category_id=$this->input->post('category_id');
        
        $where="inv.is_active=1";
        if(!empty($f_date) && !empty($to_date)){
            $f_date = date('Y-m-d',strtotime($f_date));
            $to_date = date('Y-m-d',strtotime($to_date));
            $data['f_date']=$f_date;
            $data['to_date']=$to_date;
            //$where .= " and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date')";
        }else if(!empty($f_date)){                
            $data['f_date']=$f_date;
        }else if(!empty($to_date)){                       
            $data['f_date']=$to_date;
        }

        
        if(!empty($customer_id)){
            $data['customer_id']=$customer_id;
            $where .= " and inv.customer_id=$customer_id";
        } else {
            $data['customer_id']='';
        }
        
        $postData = $this->input->post();
       
        $data['categories'] = $this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*', '', '', 'category_name');
           
        
        foreach($data['categories'] as $key=>$value){
            $opening_r_sales=array();
            $opening_sales=array();
            
            $sales=array();
            $collections=array();
            
        //    $sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.is_active=1 and (inv.status='Pending' or inv.status='Partial Received') and so.customer_id=".$value['id']." order by inv.sale_invoice_date";   
            
            if(!empty($f_date) && !empty($to_date)){
                $o_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and inv.sale_invoice_date<'$f_date' and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; 
                $ope_re_sql="select sum(invd.quantity) as total_qty,sum(invd.received_amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and inv.sale_invoice_date<'$f_date' and inv.category_id=".$value['category_id']." and invd.amount>0 and (invd.received_status='Received' or invd.received_status='Partial Received') and inv.status!='Canceled' order by inv.sale_invoice_date";
                $opening_r_sales=$this->m_common->customeQuery($ope_re_sql);
            }else{
                $o_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; 
                $opening_r_sales='';
            } 
            
            $opening_sales=$this->m_common->customeQuery($o_sql);
            
            if(!empty($opening_r_sales)){
                $op_qty=$opening_sales[0]['total_qty']-$opening_r_sales[0]['total_qty'];
                $op_amount=$opening_sales[0]['total_amount']-$opening_r_sales[0]['total_amount'];
            }else{
                if(!empty($f_date) && !empty($to_date)){
                    $op_qty=$opening_sales[0]['total_qty'];
                    $op_amount=$opening_sales[0]['total_amount'];
                }else{
                    $op_qty=0;
                    $op_amount=0;
                }
            }
                    
            $data['categories'][$key]['opening_qty']=$op_qty;
            $data['categories'][$key]['opening_amount']=$op_amount;    
            
            if(!empty($f_date) && !empty($to_date)){
                $s_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date') and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; 
                
            }else{
                $s_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where  and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; 
            }    
            $sales= $this->m_common->customeQuery($s_sql);
            $data['categories'][$key]['sale_qty']=$sales[0]['total_qty'];
            $data['categories'][$key]['sale_amount']=$sales[0]['total_amount'];   
            
            $data['categories'][$key]['receivable_qty']=$op_qty+$sales[0]['total_qty'];
            $data['categories'][$key]['receivable_amount']=$op_amount+$sales[0]['total_amount']; 
            
            if(!empty($f_date) && !empty($to_date)){
                $c_sql="select sum(invd.quantity) as total_qty,sum(invd.received_amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date') and inv.category_id=".$value['category_id']." and invd.amount>0 and (invd.received_status='Received' or invd.received_status='Partial Received') and inv.status!='Canceled' order by inv.sale_invoice_date"; 
            }else{
                $c_sql="select sum(invd.quantity) as total_qty,sum(invd.received_amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and inv.category_id=".$value['category_id']." and invd.amount>0 and (invd.received_status='Received' or invd.received_status='Partial Received') and inv.status!='Canceled' order by inv.sale_invoice_date"; 
            }    
            $collections= $this->m_common->customeQuery($c_sql);
            $data['categories'][$key]['collection_qty']=$collections[0]['total_qty'];
            $data['categories'][$key]['collection_amount']=$collections[0]['total_amount'];
            
            $data['categories'][$key]['closing_qty']=$op_qty+$sales[0]['total_qty']-$collections[0]['total_qty'];
            $data['categories'][$key]['closing_amount']=$op_amount+$sales[0]['total_amount']-$collections[0]['total_amount'];
            
        }
        $data['customers_info'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        //$data['product_categories']=$this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*'); 
        if($print == false){
            $this->load->view('sales_report/receivable_summary_report',$data);
        }else{
            $html = $this->load->view('sales_report/print_receivable_summary_report',$data,true);
            echo $html;
            exit;
        }
    }
    
    function receivableSummaryReportExcell($print = false) {
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");


        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
    //    $where = "inv.unit_id=$branch_id";
        
        $f_date=$this->input->post('from_date');
        $to_date=$this->input->post('to_date');
        $customer_id=$this->input->post('customer_id');
        $category_id=$this->input->post('category_id');
        
        $where="inv.is_active=1";
        if(!empty($f_date) && !empty($to_date)){
            $f_date = date('Y-m-d',strtotime($f_date));
            $to_date = date('Y-m-d',strtotime($to_date));
            $data['f_date']=$f_date;
            $data['to_date']=$to_date;
            //$where .= " and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date')";
        }else if(!empty($f_date)){                
            $data['f_date']=$f_date;
        }else if(!empty($to_date)){                       
            $data['f_date']=$to_date;
        }

        
        if(!empty($customer_id)){
            $data['customer_id']=$customer_id;
            $where .= " and inv.customer_id=$customer_id";
        } else {
            $data['customer_id']='';
        }
        
        $postData = $this->input->post();
       
        $data['categories'] = $this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*', '', '', 'category_name');
           
        
        foreach($data['categories'] as $key=>$value){
            $opening_r_sales=array();
            $opening_sales=array();
            
            $sales=array();
            $collections=array();
            
        //    $sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.is_active=1 and (inv.status='Pending' or inv.status='Partial Received') and so.customer_id=".$value['id']." order by inv.sale_invoice_date";   
            
            if(!empty($f_date) && !empty($to_date)){
                $o_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and inv.sale_invoice_date<'$f_date' and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; 
                $ope_re_sql="select sum(invd.quantity) as total_qty,sum(invd.received_amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and inv.sale_invoice_date<'$f_date' and inv.category_id=".$value['category_id']." and invd.amount>0 and (invd.received_status='Received' or invd.received_status='Partial Received') and inv.status!='Canceled' order by inv.sale_invoice_date";
                $opening_r_sales=$this->m_common->customeQuery($ope_re_sql);
            }else{
                $o_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; 
                $opening_r_sales='';
            } 
            
            $opening_sales=$this->m_common->customeQuery($o_sql);
            
            if(!empty($opening_r_sales)){
                $op_qty=$opening_sales[0]['total_qty']-$opening_r_sales[0]['total_qty'];
                $op_amount=$opening_sales[0]['total_amount']-$opening_r_sales[0]['total_amount'];
            }else{
                if(!empty($f_date) && !empty($to_date)){
                    $op_qty=$opening_sales[0]['total_qty'];
                    $op_amount=$opening_sales[0]['total_amount'];
                }else{
                    $op_qty=0;
                    $op_amount=0;
                }
            }
                    
            $data['categories'][$key]['opening_qty']=$op_qty;
            $data['categories'][$key]['opening_amount']=$op_amount;    
            
            if(!empty($f_date) && !empty($to_date)){
                $s_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date') and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; 
                
            }else{
                $s_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where  and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; 
            }    
            $sales= $this->m_common->customeQuery($s_sql);
            $data['categories'][$key]['sale_qty']=$sales[0]['total_qty'];
            $data['categories'][$key]['sale_amount']=$sales[0]['total_amount'];   
            
            $data['categories'][$key]['receivable_qty']=$op_qty+$sales[0]['total_qty'];
            $data['categories'][$key]['receivable_amount']=$op_amount+$sales[0]['total_amount']; 
            
            if(!empty($f_date) && !empty($to_date)){
                $c_sql="select sum(invd.quantity) as total_qty,sum(invd.received_amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date') and inv.category_id=".$value['category_id']." and invd.amount>0 and (invd.received_status='Received' or invd.received_status='Partial Received') and inv.status!='Canceled' order by inv.sale_invoice_date"; 
            }else{
                $c_sql="select sum(invd.quantity) as total_qty,sum(invd.received_amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and inv.category_id=".$value['category_id']." and invd.amount>0 and (invd.received_status='Received' or invd.received_status='Partial Received') and inv.status!='Canceled' order by inv.sale_invoice_date"; 
            }    
            $collections= $this->m_common->customeQuery($c_sql);
            $data['categories'][$key]['collection_qty']=$collections[0]['total_qty'];
            $data['categories'][$key]['collection_amount']=$collections[0]['total_amount'];
            
            $data['categories'][$key]['closing_qty']=$op_qty+$sales[0]['total_qty']-$collections[0]['total_qty'];
            $data['categories'][$key]['closing_amount']=$op_amount+$sales[0]['total_amount']-$collections[0]['total_amount'];
            
        }
        $data['customers_info'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        
        $object->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $object->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $object->getActiveSheet()->getColumnDimension('I')->setWidth(20);
        $object->getActiveSheet()->getColumnDimension('J')->setWidth(20);
        
        
        $object->getActiveSheet()->getStyle('F1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('F1')->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle('F1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
      //  $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->SetCellValue('F1','Karim Asphalt & Ready Mix Ltd.' );
        $object->getActiveSheet()->mergeCells('F1:J1');
        
        $object->getActiveSheet()->getStyle('F2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('F2')->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle('F2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
     //   $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);   
        $object->getActiveSheet()->SetCellValue('F2',$data['branch_info'][0]['dep_description'] );
        $object->getActiveSheet()->mergeCells('F2:J2');
        
        $object->getActiveSheet()->getStyle('F3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
        $object->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       // $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Invoice Aging Report');
        $object->getActiveSheet()->SetCellValue('F3','Receivable Summary Report' );
        $object->getActiveSheet()->mergeCells('F3:J3');
        
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
       

        $object->getActiveSheet()->getStyle('F1:J3')->applyFromArray($style);

        $table_columns = array("Product","Qnty.","Rate","Value","Total");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        
        $object->getActiveSheet()->getStyle('F5:J5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:J5')->getFont()->setBold(true);

        $excel_row = 7;


        if(!empty($data['categories'])){
            $total_amount=0;
            $c=count($data['categories']);
            $j=0;
            $i=0; 
             
            $object->getActiveSheet()->getStyle('F6')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('F6')->getFont()->setBold(true);
        //$object->getActiveSheet()->getStyle('F6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       // $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Invoice Aging Report');
        $object->getActiveSheet()->SetCellValue('F6','Opening Balance' );  
            foreach ($data['categories'] as $pro) {
                    $i++;
                    $j++;
                   $total_amount=$total_amount+$pro['opening_amount'];
                   if($j==$c){
                                 
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row, $pro['category_name']);                
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row, $pro['opening_qty']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row, (!empty($pro['opening_amount'])) ? round($pro['opening_amount']/$pro['opening_qty'],2) : '0.00');                               
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,number_format($pro['opening_amount'],2));                               
                    $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,number_format($total_amount,2));
                   
                   }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row, $pro['category_name']);                
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row, $pro['opening_qty']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row, (!empty($pro['opening_amount'])) ? round($pro['opening_amount']/$pro['opening_qty'],2) : '0.00');                               
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,number_format($pro['opening_amount'],2));                               
                    //$object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,number_format($total_amount,2));
                   }
                    
                
                 
                

                $excel_row++;
            }


        
        $excel_row = 10;
            $object->getActiveSheet()->getStyle('F9')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('F9')->getFont()->setBold(true);
        //$object->getActiveSheet()->getStyle('F9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       // $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Invoice Aging Report');
        $object->getActiveSheet()->SetCellValue('F9','Sales during the period' );  
        $total_amount=0;
        $c=count($data['categories']);
        $j=0;
            foreach ($data['categories'] as $pro) {
                    $i++;
                    $j++;
                   $total_amount=$total_amount+$pro['sale_amount'];
                   if($j==$c){
                                 
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row, $pro['category_name']);                
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row, $pro['sale_qty']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row, (!empty($pro['sale_amount'])) ? round($pro['sale_amount']/$pro['sale_qty'],2) : '0.00');                               
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,number_format($pro['sale_amount'],2));                               
                    $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,number_format($total_amount,2));
                   
                   }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row, $pro['category_name']);                
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row, $pro['sale_qty']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row, (!empty($pro['sale_amount'])) ? round($pro['sale_amount']/$pro['sale_qty'],2) : '0.00');                               
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,number_format($pro['sale_amount'],2));                               
                    //$object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,number_format($total_amount,2));
                   }
                    
                
                 
                

                $excel_row++;
            }


        $excel_row = 13;
            $object->getActiveSheet()->getStyle('F12')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('F12')->getFont()->setBold(true);
        //$object->getActiveSheet()->getStyle('F9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       // $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Invoice Aging Report');
        $object->getActiveSheet()->SetCellValue('F12','Total Receivable' );  
        $total_amount=0;
        $c=count($data['categories']);
        $j=0;
            foreach ($data['categories'] as $pro) {
                    $i++;
                    $j++;
                   $total_amount=$total_amount+$pro['receivable_amount'];
                   if($j==$c){
                                 
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row, $pro['category_name']);                
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row, $pro['receivable_qty']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row, (!empty($pro['receivable_amount'])) ? round($pro['receivable_amount']/$pro['receivable_qty'],2) : '0.00');                               
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,number_format($pro['receivable_amount'],2));                               
                    $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,number_format($total_amount,2));
                   
                   }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row, $pro['category_name']);                
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row, $pro['receivable_qty']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row, (!empty($pro['sale_amount'])) ? round($pro['sale_amount']/$pro['receivable_qty'],2) : '0.00');                               
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,number_format($pro['sale_amount'],2));                               
                    //$object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,number_format($total_amount,2));
                   }
                    
                
                 
                

                $excel_row++;
            }

            $excel_row = 16;
            $object->getActiveSheet()->getStyle('F15')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('F15')->getFont()->setBold(true);
        //$object->getActiveSheet()->getStyle('F9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       // $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Invoice Aging Report');
        $object->getActiveSheet()->SetCellValue('F15','Collections' );  
        $total_amount=0;
        $c=count($data['categories']);
        $j=0;
            foreach ($data['categories'] as $pro) {
                    $i++;
                    $j++;
                   $total_amount=$total_amount+$pro['collection_amount'];
                   if($j==$c){
                                 
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row, $pro['category_name']);                
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row, $pro['collection_qty']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row, (!empty($pro['collection_amount'])) ? round($pro['collection_amount']/$pro['collection_qty'],2) : '0.00');                               
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,number_format($pro['collection_amount'],2));                               
                    $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,number_format($total_amount,2));
                   
                   }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row, $pro['category_name']);                
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row, $pro['receivable_qty']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row, (!empty($pro['collection_amount'])) ? round($pro['collection_amount']/$pro['collection_qty'],2) : '0.00');                               
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,number_format($pro['collection_amount'],2));                               
                    //$object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,number_format($total_amount,2));
                   }
                    
                
                 
                

                $excel_row++;
            }

            $excel_row = 19;
            $object->getActiveSheet()->getStyle('F18')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('F18')->getFont()->setBold(true);
        //$object->getActiveSheet()->getStyle('F9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
       // $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Invoice Aging Report');
        $object->getActiveSheet()->SetCellValue('F18','Closing Balance' );  
        $total_amount=0;
        $c=count($data['categories']);
        $j=0;
            foreach ($data['categories'] as $pro) {
                    $i++;
                    $j++;
                   $total_amount=$total_amount+$pro['closing_amount'];
                   if($j==$c){
                                 
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row, $pro['category_name']);                
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row, $pro['closing_qty']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row, (!empty($pro['closing_amount'])) ? round($pro['closing_amount']/$pro['closing_qty'],2) : '0.00');                               
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,number_format($pro['closing_amount'],2));                               
                    $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,number_format($total_amount,2));
                   
                   }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row, $pro['category_name']);                
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row, $pro['receivable_qty']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row, (!empty($pro['closing_amount'])) ? round($pro['closing_amount']/$pro['closing_qty'],2) : '0.00');                               
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,number_format($pro['closing_amount'],2));                               
                    //$object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,number_format($total_amount,2));
                   }
                    
                
                 
                

                $excel_row++;
            }


        }


        

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'I'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="receivableSummaryReport.xls"');
        $object_writer->save('php://output');
    }
    
    function branchWiseSalesReport($print=false){
        $this->menu='sales';
        $this->sub_inner_menu='sales_report';
        $this->titlebackend("Report");


       // $branch_id = $this->session->userdata('companyId');
        $data['branches'] = $this->m_common->get_row_array('department',array('is_active' =>1), '*');
        $where = '';
    
        $f_date=$this->input->post('from_date');
        $to_date=$this->input->post('to_date');
        if(empty($f_date) && empty($to_date)){
           $data['f_date'] = $f_date = date('Y-m-01');
           $data['to_date'] = $to_date = date('Y-m-t');
        }
        $branch_id=$this->input->post('branch_id');
        $category_id=$this->input->post('category_id');
        
        if(!empty($branch_id)){
           $data['branch_id']=$branch_id; 
        }else{
           $data['branch_id']='';  
        }
        
       // $where="inv.is_active=1";
        $where="dcd.is_active=1";
        if(!empty($f_date) && !empty($to_date)){
            $f_date = date('Y-m-d',strtotime($f_date));
            $to_date = date('Y-m-d',strtotime($to_date));
            $data['f_date']=$f_date;
            $data['to_date']=$to_date;
            //$where .= " and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date')";
        }else if(!empty($f_date)){                
            $data['f_date']=$f_date;
        }else if(!empty($to_date)){                       
            $data['f_date']=$to_date;
        }

        
        
        
        $postData = $this->input->post();
       
        $data['categories'] = $this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*', '', '', 'category_name');
           
        
        foreach($data['categories'] as $key=>$value){
            if(!empty($branch_id)){
                $data['categories'][$key]['branches']=$this->m_common->get_row_array('department',array('is_active' => 1,'d_id'=>$branch_id),'*');
            }else{
                $data['categories'][$key]['branches']=$this->m_common->get_row_array('department',array('is_active' => 1),'*');
            }
            
            
            foreach($data['categories'][$key]['branches'] as $key1=>$value1){
            
                if(!empty($f_date) && !empty($to_date)){
                  //  $o_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and (c.customer_type is null) and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date') and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date";  
                  //  $o_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and (c.customer_type is null) and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date') and inv.category_id=".$value['category_id']." and inv.unit_id=".$value1['d_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; //based on invoice 
                     
                    $o_sql="select sum(dcd.quantity) as total_qty,sum(dcd.amount) as total_amount,c.customer_type from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders tdo on dc.do_id=tdo.do_id left join tbl_sales_orders tso on tdo.o_id=tso.o_id left join tbl_customers c on tso.customer_id=c.id left join tbl_sales_products tsp on dcd.s_item_id=tsp.product_id  where $where and (c.customer_type is null) and (dc.delivery_challan_date>='$f_date' and dc.delivery_challan_date<='$to_date') and tsp.category_id=".$value['category_id']." and dc.unit_id=".$value1['d_id']." and dcd.amount>0"; 
                    $private_sales=$this->m_common->customeQuery($o_sql);
                    $data['categories'][$key]['branches'][$key1]['private_qty']=$private_sales[0]['total_qty'];
                    $data['categories'][$key]['branches'][$key1]['private_amount']=$private_sales[0]['total_amount'];
                    
                 //   $in_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and c.customer_type='in_house' and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date') and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date";  
                 //   $in_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and c.customer_type='in_house' and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date') and inv.category_id=".$value['category_id']." and inv.unit_id=".$value1['d_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date";   //based on invoice
                    $in_sql="select sum(dcd.quantity) as total_qty,sum(dcd.amount) as total_amount,c.customer_type from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders tdo on dc.do_id=tdo.do_id left join tbl_sales_orders tso on tdo.o_id=tso.o_id left join tbl_customers c on tso.customer_id=c.id left join tbl_sales_products tsp on dcd.s_item_id=tsp.product_id  where $where and c.customer_type='in_house' and (dc.delivery_challan_date>='$f_date' and dc.delivery_challan_date<='$to_date') and tsp.category_id=".$value['category_id']." and dc.unit_id=".$value1['d_id']." and dcd.amount>0";   
                    $in_sales=$this->m_common->customeQuery($in_sql);
                    
                    $data['categories'][$key]['branches'][$key1]['inhouse_qty']=$in_sales[0]['total_qty'];
                    $data['categories'][$key]['branches'][$key1]['inhouse_amount']=$in_sales[0]['total_amount'];
                    $data['categories'][$key]['branches'][$key1]['total_qty']=$in_sales[0]['total_qty']+$private_sales[0]['total_qty'];
                    $data['categories'][$key]['branches'][$key1]['total_amount']=$in_sales[0]['total_amount']+$private_sales[0]['total_amount'];
                    
                }else{
                   // $o_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount,c.customer_type from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and (c.customer_type is null) and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; 
                   // $o_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount,c.customer_type from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and (c.customer_type is null) and inv.category_id=".$value['category_id']." and inv.unit_id=".$value1['d_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; //based on invoice  
                    $o_sql="select sum(dcd.quantity) as total_qty,sum(dcd.amount) as total_amount,c.customer_type from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders tdo on dc.do_id=tdo.do_id left join tbl_sales_orders tso on tdo.o_id=tso.o_id left join tbl_customers c on tso.customer_id=c.id left join tbl_sales_products tsp on dcd.s_item_id=tsp.product_id  where $where and (c.customer_type is null) and tsp.category_id=".$value['category_id']." and dc.unit_id=".$value1['d_id']." and dcd.amount>0";   
                    $private_sales=$this->m_common->customeQuery($o_sql);
                    $data['categories'][$key]['branches'][$key1]['private_qty']=$private_sales[0]['total_qty'];
                    $data['categories'][$key]['branches'][$key1]['private_amount']=$private_sales[0]['total_amount'];
                    
                  //  $in_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount,c.customer_type from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and c.customer_type='in_house' and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date";
                  //  $in_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount,c.customer_type from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and c.customer_type='in_house' and inv.category_id=".$value['category_id']." and inv.unit_id=".$value1['d_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; //based on invoice
                    $in_sql="select sum(dcd.quantity) as total_qty,sum(dcd.amount) as total_amount,c.customer_type from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders tdo on dc.do_id=tdo.do_id left join tbl_sales_orders tso on tdo.o_id=tso.o_id left join tbl_customers c on tso.customer_id=c.id left join tbl_sales_products tsp on dcd.s_item_id=tsp.product_id  where $where and c.customer_type='in_house' and tsp.category_id=".$value['category_id']." and dc.unit_id=".$value1['d_id']." and dcd.amount>0"; 
                    $in_sales=$this->m_common->customeQuery($in_sql);
                    
                    $data['categories'][$key]['branches'][$key1]['inhouse_qty']=$in_sales[0]['total_qty'];
                    $data['categories'][$key]['branches'][$key1]['inhouse_amount']=$in_sales[0]['total_amount'];
                    $data['categories'][$key]['branches'][$key1]['total_qty']=$in_sales[0]['total_qty']+$private_sales[0]['total_qty']; 
                    $data['categories'][$key]['branches'][$key1]['total_amount']=$in_sales[0]['total_amount']+$private_sales[0]['total_amount'];
                }
            }
            
            
            
        }
        
        if($print == false){
            $this->load->view('sales_report/branch_wise_sales_report',$data);
        }else{
            $html = $this->load->view('sales_report/print_branch_wise_sales_report',$data,true);
            echo $html;
            exit;
        }
    }
    
    function branchWiseSalesReportExcell($print=false){
        $this->menu='sales';
        $this->sub_inner_menu='sales_report';
        $this->titlebackend("Report");


       // $branch_id = $this->session->userdata('companyId');
        $data['branches'] = $this->m_common->get_row_array('department',array('is_active' =>1), '*');
        $where = '';
    
        $f_date=$this->input->post('from_date');
        $to_date=$this->input->post('to_date');
        
        if(empty($f_date) && empty($to_date)){
           $data['f_date']=$f_date=date('Y-m-01');
           $data['to_date']=$to_date=date('Y-m-t');
        }
        
        $branch_id=$this->input->post('branch_id');
        $category_id=$this->input->post('category_id');
        
        if(!empty($branch_id)){
           $data['branch_id']=$branch_id; 
        }else{
           $data['branch_id']='';  
        }
        
        //$where="inv.is_active=1";
        $where="dcd.is_active=1";
        if(!empty($f_date) && !empty($to_date)){
            $f_date = date('Y-m-d',strtotime($f_date));
            $to_date = date('Y-m-d',strtotime($to_date));
            $data['f_date']=$f_date;
            $data['to_date']=$to_date;
            //$where .= " and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date')";
        }else if(!empty($f_date)){                
            $data['f_date']=$f_date;
        }else if(!empty($to_date)){                       
            $data['f_date']=$to_date;
        }

        
        
        
        $postData = $this->input->post();
       
        $data['categories'] = $this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*', '', '', 'category_name');
           
        
        foreach($data['categories'] as $key=>$value){
            if(!empty($branch_id)){
                $data['categories'][$key]['branches']=$this->m_common->get_row_array('department',array('is_active' => 1,'d_id'=>$branch_id),'*');
            }else{
                $data['categories'][$key]['branches']=$this->m_common->get_row_array('department',array('is_active' => 1),'*');
            }
            
            
            foreach($data['categories'][$key]['branches'] as $key1=>$value1){
            
                if(!empty($f_date) && !empty($to_date)){
                    //$o_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and (c.customer_type is null) and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date') and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; 
                    $o_sql="select sum(dcd.quantity) as total_qty,sum(dcd.amount) as total_amount,c.customer_type from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders tdo on dc.do_id=tdo.do_id left join tbl_sales_orders tso on tdo.o_id=tso.o_id left join tbl_customers c on tso.customer_id=c.id left join tbl_sales_products tsp on dcd.s_item_id=tsp.product_id  where $where and (c.customer_type is null) and (dc.delivery_challan_date>='$f_date' and dc.delivery_challan_date<='$to_date') and tsp.category_id=".$value['category_id']." and dc.unit_id=".$value1['d_id']." and dcd.amount>0";
                    $private_sales=$this->m_common->customeQuery($o_sql);
                    $data['categories'][$key]['branches'][$key1]['private_qty']=$private_sales[0]['total_qty'];
                    $data['categories'][$key]['branches'][$key1]['private_amount']=$private_sales[0]['total_amount'];
                    
                    //$in_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and c.customer_type='in_house' and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date') and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date";     
                    $in_sql="select sum(dcd.quantity) as total_qty,sum(dcd.amount) as total_amount,c.customer_type from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders tdo on dc.do_id=tdo.do_id left join tbl_sales_orders tso on tdo.o_id=tso.o_id left join tbl_customers c on tso.customer_id=c.id left join tbl_sales_products tsp on dcd.s_item_id=tsp.product_id  where $where and c.customer_type='in_house' and (dc.delivery_challan_date>='$f_date' and dc.delivery_challan_date<='$to_date') and tsp.category_id=".$value['category_id']." and dc.unit_id=".$value1['d_id']." and dcd.amount>0"; 
                    $in_sales=$this->m_common->customeQuery($in_sql);
                    
                    $data['categories'][$key]['branches'][$key1]['inhouse_qty']=$in_sales[0]['total_qty'];
                    $data['categories'][$key]['branches'][$key1]['inhouse_amount']=$in_sales[0]['total_amount'];
                    $data['categories'][$key]['branches'][$key1]['total_qty']=$in_sales[0]['total_qty']+$private_sales[0]['total_qty'];
                    $data['categories'][$key]['branches'][$key1]['total_amount']=$in_sales[0]['total_amount']+$private_sales[0]['total_amount'];
                    
                }else{
                    //$o_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount,c.customer_type from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and (c.customer_type is null) and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date";  
                    $o_sql="select sum(dcd.quantity) as total_qty,sum(dcd.amount) as total_amount,c.customer_type from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders tdo on dc.do_id=tdo.do_id left join tbl_sales_orders tso on tdo.o_id=tso.o_id left join tbl_customers c on tso.customer_id=c.id left join tbl_sales_products tsp on dcd.s_item_id=tsp.product_id  where $where and (c.customer_type is null) and tsp.category_id=".$value['category_id']." and dc.unit_id=".$value1['d_id']." and dcd.amount>0";  
                    $private_sales=$this->m_common->customeQuery($o_sql);
                    $data['categories'][$key]['branches'][$key1]['private_qty']=$private_sales[0]['total_qty'];
                    $data['categories'][$key]['branches'][$key1]['private_amount']=$private_sales[0]['total_amount'];
                    
                    //$in_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount,c.customer_type from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and c.customer_type='in_house' and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date";    
                    $in_sql="select sum(dcd.quantity) as total_qty,sum(dcd.amount) as total_amount,c.customer_type from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders tdo on dc.do_id=tdo.do_id left join tbl_sales_orders tso on tdo.o_id=tso.o_id left join tbl_customers c on tso.customer_id=c.id left join tbl_sales_products tsp on dcd.s_item_id=tsp.product_id  where $where and c.customer_type='in_house' and tsp.category_id=".$value['category_id']." and dc.unit_id=".$value1['d_id']." and dcd.amount>0"; 
                    $in_sales=$this->m_common->customeQuery($in_sql);
                    
                    $data['categories'][$key]['branches'][$key1]['inhouse_qty']=$in_sales[0]['total_qty'];
                    $data['categories'][$key]['branches'][$key1]['inhouse_amount']=$in_sales[0]['total_amount'];
                    $data['categories'][$key]['branches'][$key1]['total_qty']=$in_sales[0]['total_qty']+$private_sales[0]['total_qty']; 
                   $data['categories'][$key]['branches'][$key1]['total_amount']=$in_sales[0]['total_amount']+$private_sales[0]['total_amount'];
                }
            }
            
            
            
        }
        
        
          //generate excel file from here 
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        
        
        $i = 3;
        
        $objPHPExcel->getActiveSheet()->mergeCells("A1:G1");
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize('15');
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(false);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'Branch Wise Sales Report' );
        
        $objPHPExcel->getActiveSheet()->mergeCells("A2:G2");
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setSize('15');
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getFont()->setBold(false);
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        if(!empty($f_date) && !empty($to_date)){
            $objPHPExcel->getActiveSheet()->SetCellValue('A2',"From ".date('d-m-Y',strtotime($f_date))." To ".date('d-m-Y',strtotime($to_date)) );
        }else{
            $objPHPExcel->getActiveSheet()->SetCellValue('A2','');
        }
        
        
        $objPHPExcel->getActiveSheet()->mergeCells("A" . ($i) . ":A" . ($i + 1));
        $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setSize('12');
        $objPHPExcel->getActiveSheet()->getStyle('A3')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->SetCellValue('A3','Product Name');
        
        $objPHPExcel->getActiveSheet()->mergeCells("B" . ($i) . ":C3");
        $objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setSize('12');
        $objPHPExcel->getActiveSheet()->getStyle('B3')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Private');
        
        
        
        $objPHPExcel->getActiveSheet()->mergeCells("D".($i).":E3");
        $objPHPExcel->getActiveSheet()->getStyle('D3')->getFont()->setSize('12');
        $objPHPExcel->getActiveSheet()->getStyle('D3')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'In House');
        
        
        
        $objPHPExcel->getActiveSheet()->mergeCells("F" . ($i) . ":G3");
        $objPHPExcel->getActiveSheet()->getStyle('F3')->getFont()->setSize('12');
        $objPHPExcel->getActiveSheet()->getStyle('F3')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F3')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Total');
        
        
        $objPHPExcel->getActiveSheet()->getStyle('B4')->getFont()->setSize('12');
        $objPHPExcel->getActiveSheet()->getStyle('B4')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('B4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Quantity');
        
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getFont()->setSize('12');
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('C4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Value');
        
        $objPHPExcel->getActiveSheet()->getStyle('D4')->getFont()->setSize('12');
        $objPHPExcel->getActiveSheet()->getStyle('D4')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('D4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Quantity');
        
        $objPHPExcel->getActiveSheet()->getStyle('E4')->getFont()->setSize('12');
        $objPHPExcel->getActiveSheet()->getStyle('E4')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('E4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('E4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Value');
        
        
        $objPHPExcel->getActiveSheet()->getStyle('F4')->getFont()->setSize('12');
        $objPHPExcel->getActiveSheet()->getStyle('F4')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('F4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('F4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Quantity');
        
        
        $objPHPExcel->getActiveSheet()->getStyle('G4')->getFont()->setSize('12');
        $objPHPExcel->getActiveSheet()->getStyle('G4')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('G4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('G4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Value');
        
//        $ye=date('m')*2+8;
//        $w=numberToWord($ye);
        
        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $objPHPExcel->getActiveSheet()->getStyle('A3:G4')->applyFromArray($styleArray);
        $objPHPExcel->getActiveSheet()->getStyle('A3:G4')->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB('EEEEEE');
        
        $m=0;
        $i=4;
        
        $grand_total_private=0;
        $grand_total_inhouse=0;
        $grand_total_all=0;
        
        foreach ($data['categories'] as $key4=>$row){
            $private_qty_total=0;
            $private_amount_total=0;
            $inhouse_qty_total=0;
            $inhouse_amount_total=0;
            $net_total_qty=0;
            $net_total_amount=0;
            
            
            $i++;
            $j = $i;
            
            $objPHPExcel->getActiveSheet()->mergeCells("A" . ($i) . ":G".$j);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $j)->getFont()->setSize('12');
            $objPHPExcel->getActiveSheet()->getStyle('A' . $j)->getFont()->setBold(false);
            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $j,$row['category_name']);
            
            
            $styleArray = array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                );

            $objPHPExcel->getActiveSheet()->getStyle('A' . $j . ':G'.$j)->applyFromArray($styleArray);
            
            
            foreach($row['branches'] as $key5=>$bran){ 
                $i++;
                $j = $i;
                
                $private_qty_total=$private_qty_total+$bran['private_qty'];
                $private_amount_total=$private_amount_total+$bran['private_amount'];
                $inhouse_qty_total=$inhouse_qty_total+$bran['inhouse_qty'];
                $inhouse_amount_total=$inhouse_amount_total+$bran['inhouse_amount'];
                $net_total_amount=$net_total_amount+$bran['total_amount'];
                $net_total_qty=$net_total_qty+$bran['total_qty'];

                $grand_total_private=$grand_total_private+$bran['private_amount'];
                $grand_total_inhouse=$grand_total_inhouse+$bran['inhouse_amount'];
                $grand_total_all=$grand_total_all+$bran['total_amount'];
                
                
                
                $objPHPExcel->getActiveSheet()->getStyle('A' . $j)->getFont()->setSize('12');
                $objPHPExcel->getActiveSheet()->getStyle('A' . $j)->getFont()->setBold(false);
                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $j,$bran['dep_description']);
            
                $objPHPExcel->getActiveSheet()->getStyle('B' . $j)->getFont()->setSize('12');
                $objPHPExcel->getActiveSheet()->getStyle('B' . $j)->getFont()->setBold(false);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $j, $bran['private_qty']);

                $objPHPExcel->getActiveSheet()->getStyle('C' . $j)->getFont()->setSize('12');
                $objPHPExcel->getActiveSheet()->getStyle('C' . $j)->getFont()->setBold(false);
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $j, $bran['private_amount']);

                $objPHPExcel->getActiveSheet()->getStyle('D' . $j)->getFont()->setSize('12');
                $objPHPExcel->getActiveSheet()->getStyle('D' . $j)->getFont()->setBold(false);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $j,$bran['inhouse_qty']);

                $objPHPExcel->getActiveSheet()->getStyle('E' . $j)->getFont()->setSize('12');
                $objPHPExcel->getActiveSheet()->getStyle('E' . $j)->getFont()->setBold(false);
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $j,$bran['inhouse_amount']);

                $objPHPExcel->getActiveSheet()->getStyle('F' . $j)->getFont()->setSize('12');
                $objPHPExcel->getActiveSheet()->getStyle('F' . $j)->getFont()->setBold(false);
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $j,$bran['total_qty']);
               

                $objPHPExcel->getActiveSheet()->getStyle('G' . $j)->getFont()->setSize('12');
                $objPHPExcel->getActiveSheet()->getStyle('G' . $j)->getFont()->setBold(false);
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $j,$bran['total_amount']);
                
                
                
                $styleArray = array(
                    'borders' => array(
                        'allborders' => array(
                            'style' => PHPExcel_Style_Border::BORDER_THIN
                        )
                    )
                );

                $objPHPExcel->getActiveSheet()->getStyle('A' . $j . ':G'.$j)->applyFromArray($styleArray);
            //    $object->getActiveSheet()->getStyle('B' . $j . ':G'.$j)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            }
            
            $i++;
            $j = $i;
            
            $objPHPExcel->getActiveSheet()->getStyle('A'.$j)->getFont()->setSize('12');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$j)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$j,"Sub Total");

            $objPHPExcel->getActiveSheet()->getStyle('B'.$j)->getFont()->setSize('12');
            $objPHPExcel->getActiveSheet()->getStyle('B' . $j)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $j,$private_qty_total);

            $objPHPExcel->getActiveSheet()->getStyle('C' . $j)->getFont()->setSize('12');
            $objPHPExcel->getActiveSheet()->getStyle('C' . $j)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $j,$private_amount_total);

            $objPHPExcel->getActiveSheet()->getStyle('D'.$j)->getFont()->setSize('12');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$j)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$j,$inhouse_qty_total);

            $objPHPExcel->getActiveSheet()->getStyle('E'.$j)->getFont()->setSize('12');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$j)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$j,$inhouse_amount_total);

            $objPHPExcel->getActiveSheet()->getStyle('F'.$j)->getFont()->setSize('12');
            $objPHPExcel->getActiveSheet()->getStyle('F'.$j)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$j,$net_total_qty);


            $objPHPExcel->getActiveSheet()->getStyle('G'.$j)->getFont()->setSize('12');
            $objPHPExcel->getActiveSheet()->getStyle('G'.$j)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$j,$net_total_amount);



            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );

            $objPHPExcel->getActiveSheet()->getStyle('A' . $j . ':G'.$j)->applyFromArray($styleArray); 
          //  $object->getActiveSheet()->getStyle('B' . $j . ':G'.$j)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

            
           
        }
        
        
        
            $i++;
            $j=$i;
            
            $objPHPExcel->getActiveSheet()->getStyle('A'.$j)->getFont()->setSize('12');
            $objPHPExcel->getActiveSheet()->getStyle('A'.$j)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$j,"Grand Total");

            $objPHPExcel->getActiveSheet()->getStyle('B'.$j)->getFont()->setSize('12');
            $objPHPExcel->getActiveSheet()->getStyle('B' . $j)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $j,'');

            $objPHPExcel->getActiveSheet()->getStyle('C' . $j)->getFont()->setSize('12');
            $objPHPExcel->getActiveSheet()->getStyle('C' . $j)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $j,$grand_total_private);

            $objPHPExcel->getActiveSheet()->getStyle('D'.$j)->getFont()->setSize('12');
            $objPHPExcel->getActiveSheet()->getStyle('D'.$j)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$j,'');

            $objPHPExcel->getActiveSheet()->getStyle('E'.$j)->getFont()->setSize('12');
            $objPHPExcel->getActiveSheet()->getStyle('E'.$j)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$j,$grand_total_inhouse);

            $objPHPExcel->getActiveSheet()->getStyle('F'.$j)->getFont()->setSize('12');
            $objPHPExcel->getActiveSheet()->getStyle('F'.$j)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$j,'');


            $objPHPExcel->getActiveSheet()->getStyle('G'.$j)->getFont()->setSize('12');
            $objPHPExcel->getActiveSheet()->getStyle('G'.$j)->getFont()->setBold(true);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$j,$grand_total_all); 
        
            
            
            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );
            
            $objPHPExcel->getActiveSheet()->getStyle('B5:G'.$j)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $objPHPExcel->getActiveSheet()->getStyle('A' . $j . ':G'.$j)->applyFromArray($styleArray); 
        
        
        // Auto size columns for each worksheet
        for ($col = 'A'; $col !== 'M'; $col++) {
            $objPHPExcel->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }
        
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $filename = 'branchWiseSalesReport.xls'; //save our workbook as this file name
        header('Content-Type: application/vnd.ms-excel'); //mime type
        header('Content-Disposition: attachment;filename="' . $filename . '"'); //tell browser what's the file name
        header('Cache-Control: max-age=0'); //no cache
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        
        
        
        
    }
    
    
    
    function customersChequeBgLcAtHand($print = false) {
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
    //    $sql = "select pc.*,so.order_no,so.project_name,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name from tbl_payment_collections pc left join  tbl_sales_orders so on pc.o_id=so.o_id left join tbl_banks b on pc.bank_id=b.id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where pc.is_active=1 and pc.payment_status='Pending' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') ";
    //    $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id  where pc.is_active=1 and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') ";
        
        $postData = $this->input->post();
        
        $c_sql = "select c.* from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id  where pc.is_active=1 and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') group by pc.customer_id ";
        $data['customers'] = $this->m_common->customeQuery($c_sql);
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories','','*');
        
        $customer_id = $this->input->post('customer_id');
        
        $data['customer_id'] =$customer_id;
        
        if(!empty($customer_id)){
            $data['all_customers']=$this->m_common->get_row_array('tbl_customers',array('id'=>$customer_id),'*','','','c_name','asc');
        }else{
            $data['all_customers']=$this->m_common->get_row_array('tbl_customers','','*','','','c_name','asc');
        }
        
        $where = "pc.is_active=1";
        if(!empty($postData)){
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
//            if (!empty($customer_id)) {
//                $data['customer_id'] =$customer_id;
//                if (empty($where)) {
//                    $where .= "pc.customer_id=$customer_id";
//                } else {
//                    $where .= " and pc.customer_id=$customer_id";
//                }
//                //$data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
//            } else {
//                //$data['projects'] = '';
//            }
            
            foreach($data['all_customers'] as $key=>$customers){
                $orders=array();
                if(!empty($f_date) & !empty($to_date)){              
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.customer_id=".$customer['id']." and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else{                
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.customer_id=".$customer['id']." and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                } 
                $orders=$this->m_common->customeQuery($sql);
                if(!empty($orders)){
                    $data['all_customers'][$key]['orders']=$orders;
                }else{
                    unset($data['all_customers'][$key]);
                }
            }
             
             
        }else{
            $sql="select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
        }
        
        
        $data['orders'] = $this->m_common->customeQuery($sql);

        if($print == false){
            $this->load->view('sales_report/v_customer_cheque_at_hand',$data);
        }else{
            $html = $this->load->view('sales_report/print_cheque_at_hand',$data,true);
            echo $html;
            exit;
        }
    }
    
    
    function customersChequeBgLcAtHandExcel($print = false) {
        $this->load->library("PHPExcel");
        $postData = $this->input->post();
                
        $where = "pc.is_active=1";
        if(!empty($postData)){
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] =$customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                //$data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                //$data['projects'] = '';
            }
            

             if(!empty($f_date) & !empty($to_date)){              
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }else if (!empty($f_date)) {              
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }else if (!empty($to_date)) {               
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date<='" . $to_date . "' and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }else{                
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }   
        }else{
            $sql="select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
        }
        
        
        $data['orders'] = $this->m_common->customeQuery($sql);


        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Cheque/PO/BG At Hand');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:N3')->applyFromArray($style);

     //   $table_columns = array("SL", "S. Order", "Customer Name.", "Project", "Pdc/Lc/Bg No.", "Pdc/Lc/Bg Date", "Mat Date", "Bank", "Value");
        $table_columns = array("SL","Receive Date","Customer Name.","Product Type","Collection Method","Pdc/Lc/Bg No.", "Pdc/Lc/Bg Date","Bank", "Value");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setBold(true);


        $excel_row = 6;


        if (!empty($data['orders'])) {
            $total = 0;
            $i = 0;
            foreach ($data['orders'] as $order) {
                $i++;
                $total = $total + $order['amount'];
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $order['receive_date']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $order['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $order['category_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $order['collection_method']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $order['no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $order['check_date']);
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $order['b_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, round($order['amount'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row,'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row,round($total,2));
        
        $object->getActiveSheet()->getStyle("J$excel_row:N$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("J$excel_row:N$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:N'. $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('N6:N'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'N'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="cheque_at_hand.xls"');
        $object_writer->save('php://output');
    }
    
    
    
    function chequeInAccount($print = false) {
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
    //    $sql = "select pc.*,so.order_no,so.project_name,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name from tbl_payment_collections pc left join  tbl_sales_orders so on pc.o_id=so.o_id left join tbl_banks b on pc.bank_id=b.id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where pc.is_active=1 and pc.payment_status='Pending' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') ";
    //    $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id  where pc.is_active=1 and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') ";
        
        $postData = $this->input->post();
        
        $data['cheque_position']='';
        
        $c_sql = "select c.* from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id  where pc.is_active=1 and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') group by pc.customer_id ";
        $data['customers'] = $this->m_common->customeQuery($c_sql);
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories','','*');
        
        $where = "pc.is_active=1";
        if(!empty($postData)){
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            $cheque_position=$this->input->post('cheque_position');
            $data['cheque_position']=$cheque_position;
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] =$customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                //$data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                //$data['projects'] = '';
            }
            

             if($cheque_position=='bank'){
                if(!empty($f_date) & !empty($to_date)){              
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and (pc.payment_status='Deposited' and pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else if (!empty($f_date)) {              
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and (pc.payment_status='Deposited' and pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else if (!empty($to_date)) {               
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date<='" . $to_date . "' and (pc.payment_status='Deposited' and pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else{                
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and (pc.payment_status='Deposited' and pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }  
            }else if($cheque_position=='office'){
                if(!empty($f_date) & !empty($to_date)){              
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and (pc.payment_status!='Deposited' and pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else if (!empty($f_date)) {              
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and (pc.payment_status!='Deposited' and pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else if (!empty($to_date)) {               
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date<='" . $to_date . "' and (pc.payment_status!='Deposited' and pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else{                
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and (pc.payment_status!='Deposited' and pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }  
            }else{
               if(!empty($f_date) & !empty($to_date)){              
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and (pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else if (!empty($f_date)) {              
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and (pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else if (!empty($to_date)) {               
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date<='" . $to_date . "' and (pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else{                
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and (pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }   
            }  
        }else{
            $sql="select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and (pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.check_date ASC,pc.bg_issue_date ASC";
        }
        
        
        $data['orders'] = $this->m_common->customeQuery($sql);
        
        if($print == false){
            $this->load->view('sales_report/v_cheque_in_account',$data);
        }else{
            $html = $this->load->view('sales_report/print_cheque_in_account',$data,true);
            echo $html;
            exit;
        }
    }
    
    function chequeInAccountExcel($print = false) {
        
        $this->load->library("PHPExcel");        
        $postData = $this->input->post();
                
        $where = "pc.is_active=1";
        if(!empty($postData)){
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            $cheque_position=$this->input->post('cheque_position');
            $data['cheque_position']=$cheque_position;
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] =$customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                //$data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                //$data['projects'] = '';
            }
            
            if($cheque_position=='bank'){
                if(!empty($f_date) & !empty($to_date)){              
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and (pc.payment_status='Deposited' and pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else if (!empty($f_date)) {              
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and (pc.payment_status='Deposited' and pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else if (!empty($to_date)) {               
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date<='" . $to_date . "' and (pc.payment_status='Deposited' and pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else{                
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and (pc.payment_status='Deposited' and pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }  
            }else if($cheque_position=='office'){
                if(!empty($f_date) & !empty($to_date)){              
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and (pc.payment_status!='Deposited' and pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else if (!empty($f_date)) {              
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and (pc.payment_status!='Deposited' and pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else if (!empty($to_date)) {               
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date<='" . $to_date . "' and (pc.payment_status!='Deposited' and pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else{                
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and (pc.payment_status!='Deposited' and pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }  
            }else{
               if(!empty($f_date) & !empty($to_date)){              
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and (pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else if (!empty($f_date)) {              
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and (pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else if (!empty($to_date)) {               
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date<='" . $to_date . "' and (pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }else{                
                   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and (pc.payment_status!='Received' and pc.payment_status!='Returned') and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
                }   
            }
        }else{
            $sql="select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and and (pc.payment_status!='Received' and pc.payment_status!='Returned') and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
        }
        
        
        $data['orders'] = $this->m_common->customeQuery($sql);


        $object = new PHPExcel();
        
        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Cheque/PO/BG At Hand');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:N3')->applyFromArray($style);

     //   $table_columns = array("SL", "S. Order", "Customer Name.", "Project", "Pdc/Lc/Bg No.", "Pdc/Lc/Bg Date", "Mat Date", "Bank", "Value");
        $table_columns = array("SL","Receive Date","Customer Name.","Product Type","Collection Method","Pdc/Lc/Bg No.", "Pdc/Lc/Bg Date","Bank", "Value");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setBold(true);


        $excel_row = 6;


        if (!empty($data['orders'])) {
            $total = 0;
            $i = 0;
            foreach ($data['orders'] as $order) {
                $i++;
                $total = $total + $order['amount'];
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $order['receive_date']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $order['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $order['category_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $order['collection_method']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $order['no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $order['check_date']);
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $order['b_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, round($order['amount'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row,'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row,round($total,2));
        
        $object->getActiveSheet()->getStyle("J$excel_row:N$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("J$excel_row:N$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:N'. $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('N6:N'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'N'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="cheque_in_account.xls"');
        header('Cache-Control: max-age=0');
        $object_writer->save('php://output');
        
    }
    
    
   
    
    
    
    
    
    
    
    function handsToDeposit($print = false) {
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
    //    $sql = "select pc.*,so.order_no,so.project_name,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name from tbl_payment_collections pc left join  tbl_sales_orders so on pc.o_id=so.o_id left join tbl_banks b on pc.bank_id=b.id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where pc.is_active=1 and pc.payment_status='Pending' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') ";
    //    $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id  where pc.is_active=1 and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') ";
        
        $postData = $this->input->post();
        
        $c_sql = "select c.* from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id  where pc.is_active=1 and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') group by pc.customer_id ";
        $data['customers'] = $this->m_common->customeQuery($c_sql);
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories','','*');
        
        $where = "pc.is_active=1";
        if(!empty($postData)){
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] =$customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                //$data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                //$data['projects'] = '';
            }
            

             if(!empty($f_date) & !empty($to_date)){              
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }else if (!empty($f_date)) {              
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }else if (!empty($to_date)) {               
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date<='" . $to_date . "' and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }else{                
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }   
        }else{
            $sql="select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
        }
        
        
        $data['orders'] = $this->m_common->customeQuery($sql);

        if($print == false){
            $this->load->view('sales_report/v_cheque_have_to_deposit',$data);
        }else{
            $html = $this->load->view('sales_report/print_cheque_at_hand',$data,true);
            echo $html;
            exit;
        }
    }
    
    
    function handsToDepositExcel($print = false) {
        
        $this->load->library("PHPExcel");
        
        $postData = $this->input->post();
                
        $where = "pc.is_active=1";
        if(!empty($postData)){
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] =$customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                //$data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                //$data['projects'] = '';
            }
            

             if(!empty($f_date) & !empty($to_date)){              
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }else if (!empty($f_date)) {              
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }else if (!empty($to_date)) {               
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date<='" . $to_date . "' and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }else{                
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }   
        }else{
            $sql="select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
        }
        
        
        $data['orders'] = $this->m_common->customeQuery($sql);


        $object = new PHPExcel();
        
        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Cheque/PO/BG At Hand');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:N3')->applyFromArray($style);

     //   $table_columns = array("SL", "S. Order", "Customer Name.", "Project", "Pdc/Lc/Bg No.", "Pdc/Lc/Bg Date", "Mat Date", "Bank", "Value");
        $table_columns = array("SL","Receive Date","Customer Name.","Product Type","Collection Method","Pdc/Lc/Bg No.", "Pdc/Lc/Bg Date","Bank", "Value");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setBold(true);


        $excel_row = 6;


        if (!empty($data['orders'])) {
            $total = 0;
            $i = 0;
            foreach ($data['orders'] as $order) {
                $i++;
                $total = $total + $order['amount'];
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $order['receive_date']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $order['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $order['category_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $order['collection_method']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $order['no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $order['check_date']);
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $order['b_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, round($order['amount'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row,'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row,round($total,2));
        
        $object->getActiveSheet()->getStyle("J$excel_row:N$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("J$excel_row:N$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:N'. $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('N6:N'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'N'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="cheque_at_hand.xls"');
        header('Cache-Control: max-age=0');
        $object_writer->save('php://output');
        
    }
    
    
    function handsToRealized($print = false){
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
     //   $sql = "select pc.*,so.order_no,so.project_name,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name from tbl_payment_collections pc left join  tbl_sales_orders so on pc.o_id=so.o_id left join tbl_banks b on pc.bank_id=b.id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where pc.is_active=1 and pc.payment_status='Pending' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') ";
     //   $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name from tbl_deposit_realization tdr left join  tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id  where pc.is_active=1 and tdr.realization_status='Deposited' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po' or collection_method='O.Cash') ";
        $postData = $this->input->post();
        
        $c_sql = "select c.* from tbl_deposit_realization tdr left join  tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_customers c on pc.customer_id=c.id  where pc.is_active=1 and tdr.realization_status='Deposited' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') group by pc.customer_id ";
        $data['customers'] = $this->m_common->customeQuery($c_sql);
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories','','*');
        
        $where = "pc.is_active=1";
        if(!empty($postData)){
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] =$customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                //$data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                //$data['projects'] = '';
            }
            

             if(!empty($f_date) & !empty($to_date)){              
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name,tdr.deposit_date from tbl_deposit_realization tdr left join  tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and tdr.deposit_date>='" . $f_date . "' and tdr.deposit_date<='" . $to_date . "' and tdr.realization_status='Deposited' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }else if (!empty($f_date)) {              
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name,tdr.deposit_date from tbl_deposit_realization tdr left join  tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and tdr.deposit_date>='" . $f_date . "' and tdr.realization_status='Deposited' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }else if (!empty($to_date)) {               
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name,tdr.deposit_date from tbl_deposit_realization tdr left join  tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and tdr.deposit_date<='" . $to_date . "' and tdr.realization_status='Deposited' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }else{                
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name,tdr.deposit_date from tbl_deposit_realization tdr left join  tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and tdr.realization_status='Deposited' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }   
        }else{
            $sql="select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name,tdr.deposit_date from tbl_deposit_realization tdr left join  tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and tdr.realization_status='Deposited' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
        }
        
        
        $data['orders'] = $this->m_common->customeQuery($sql);

        if($print == false){
            $this->load->view('sales_report/v_have_to_realized', $data);
        } else {
            $html = $this->load->view('sales_report/print_have_to_realized', $data, true);
            echo $html;
            exit;
        }
    }

    function handsToRealizedExcel($print = false) {
        $this->load->library("PHPExcel");
      //  $sql = "select pc.*,so.order_no,so.project_name,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name from tbl_payment_collections pc left join  tbl_sales_orders so on pc.o_id=so.o_id left join tbl_banks b on pc.bank_id=b.id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where pc.is_active=1 and pc.payment_status='Pending' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') ";
       // $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name from tbl_payment_collections pc left join tbl_banks b on pc.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id  where pc.is_active=1 and pc.payment_status='Collected' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') ";
        //$sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name from tbl_deposit_realization tdr left join  tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id  where pc.is_active=1 and tdr.realization_status='Deposited' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po' or collection_method='O.Cash') ";
        
        
        $postData = $this->input->post();
        
        
        
        $where = "pc.is_active=1";
        if(!empty($postData)){
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] =$customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                //$data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                //$data['projects'] = '';
            }
            

             if(!empty($f_date) & !empty($to_date)){              
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name,tdr.deposit_date from tbl_deposit_realization tdr left join  tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and tdr.deposit_date>='" . $f_date . "' and tdr.deposit_date<='" . $to_date . "' and tdr.realization_status='Deposited' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }else if (!empty($f_date)) {              
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name,tdr.deposit_date from tbl_deposit_realization tdr left join  tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and tdr.deposit_date>='" . $f_date . "' and tdr.realization_status='Deposited' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }else if (!empty($to_date)) {               
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name,tdr.deposit_date from tbl_deposit_realization tdr left join  tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and tdr.deposit_date<='" . $to_date . "' and tdr.realization_status='Deposited' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }else{                
                $sql = "select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name,tdr.deposit_date from tbl_deposit_realization tdr left join  tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and tdr.realization_status='Deposited' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
             }   
        }else{
            $sql="select pc.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name,tdr.deposit_date from tbl_deposit_realization tdr left join  tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and tdr.realization_status='Deposited' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') order by pc.receive_date DESC";
        }
        
        $data['orders'] = $this->m_common->customeQuery($sql);


        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Cheque/PO/BG At Bank');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:N3')->applyFromArray($style);

     //   $table_columns = array("SL", "S. Order", "Customer Name.", "Project", "Pdc/Lc/Bg No.", "Pdc/Lc/Bg Date", "Mat Date", "Bank", "Value");
        $table_columns = array("SL","Deposit Date","Customer Name.","Product Type","Collection Method","Pdc/Lc/Bg No.", "Pdc/Lc/Bg Date","Bank", "Value");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setBold(true);


        $excel_row = 6;


        if (!empty($data['orders'])) {
            $total = 0;
            $i = 0;
            foreach ($data['orders'] as $order) {
                $i++;
                $total = $total + $order['amount'];
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $order['deposit_date']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $order['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $order['category_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $order['collection_method']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $order['no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $order['check_date']);
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $order['b_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, round($order['amount'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row,'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row,round($total,2));
        
        $object->getActiveSheet()->getStyle("J$excel_row:N$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("J$excel_row:N$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:N'. $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('N6:N'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'K'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="cheque_at_bank.xls"');
        $object_writer->save('php://output');
    }
    
    
    function cashReceived($print = false){
        $this->menu='sales';
        $this->sub_inner_menu='sales_report';
        $this->titlebackend("Report");
        $postData = $this->input->post();
        
        $c_sql = "select c.* from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id  where pc.is_active=1 and pc.payment_status='Received' and pc.collection_method='Cash' group by pc.customer_id ";
        $data['customers'] = $this->m_common->customeQuery($c_sql);
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories','','*');
        $where = "pc.is_active=1";
        if(!empty($postData)){
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['collection_method'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] =$customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                //$data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                //$data['projects'] = '';
            }

             if(!empty($f_date) & !empty($to_date)){              
                $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name from tbl_payment_collections pc left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and pc.payment_status='Received' and pc.collection_method='Cash' order by pc.receive_date DESC";
             }else if (!empty($f_date)) {              
                $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name from tbl_payment_collections pc left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.payment_status='Received' and pc.collection_method='Cash' order by pc.receive_date DESC";
             }else if (!empty($to_date)) {               
                $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name from tbl_payment_collections pc left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date<='" . $to_date . "' and pc.payment_status='Received' and pc.collection_method='Cash' order by pc.receive_date DESC";
             }else{                
                $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name from tbl_payment_collections pc left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Received' and pc.collection_method='Cash' order by pc.receive_date DESC";
             }   
        }else{
            $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name from tbl_payment_collections pc left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Received' and pc.collection_method='Cash' order by pc.receive_date DESC";
        }
        $data['orders'] = $this->m_common->customeQuery($sql);
        
        

        if($print == false){
            $this->load->view('sales_report/v_cash_received',$data);
        } else {
            $html=$this->load->view('sales_report/print_cash_received', $data, true);
            echo $html;
            exit;
        }
    }
    
    
    function cashReceivedExcel($print = false){
        $this->load->library("PHPExcel");
        $postData = $this->input->post();
        $where = "pc.is_active=1";
        if(!empty($postData)){
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['collection_method'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] =$customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                //$data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                //$data['projects'] = '';
            }

             if(!empty($f_date) & !empty($to_date)){              
                $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name from tbl_payment_collections pc left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "' and pc.payment_status='Received' and pc.collection_method='Cash' order by pc.receive_date DESC";
             }else if (!empty($f_date)) {              
                $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name from tbl_payment_collections pc left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date . "' and pc.payment_status='Received' and pc.collection_method='Cash' order by pc.receive_date DESC";
             }else if (!empty($to_date)) {               
                $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name from tbl_payment_collections pc left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date<='" . $to_date . "' and pc.payment_status='Received' and pc.collection_method='Cash' order by pc.receive_date DESC";
             }else{                
                $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name from tbl_payment_collections pc left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Received' and pc.collection_method='Cash' order by pc.receive_date DESC";
             }   
        }else{
            $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name from tbl_payment_collections pc left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Received' and pc.collection_method='Cash' order by pc.receive_date DESC";
        }
        $data['orders'] = $this->m_common->customeQuery($sql);


        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Cash Received Report');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:N3')->applyFromArray($style);

     //   $table_columns = array("SL", "S. Order", "Customer Name.", "Project", "Pdc/Lc/Bg No.", "Pdc/Lc/Bg Date", "Mat Date", "Bank", "Value");
        $table_columns = array("SL","Receive Date","Customer Name.","Product Type","Collection Method","Value");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setBold(true);


        $excel_row = 6;


        if (!empty($data['orders'])) {
            $total = 0;
            $i = 0;
            foreach ($data['orders'] as $order) {
                $i++;
                $total = $total + $order['amount'];
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $order['receive_date']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $order['c_name']);  
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $order['category_name']); 
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $order['collection_method']); 
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, round($order['amount'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, 'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, round($total, 2));
        $object->getActiveSheet()->getStyle("J$excel_row:L$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("J$excel_row:L$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:K' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('K6:K'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'M'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="cash_received.xls"');
        $object_writer->save('php://output');
    }
    
    
    function totalReceivingReport($print = false){
        $this->menu='sales';
        $this->sub_inner_menu='sales_report';
        $this->titlebackend("Report");
        $postData = $this->input->post();
        
        $c_sql = "select c.* from tbl_deposit_realization tdr left join tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id  where pc.is_active=1 and tdr.realization_status='Honored' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') group by pc.customer_id order by c.c_name";
        $data['customers'] = $this->m_common->customeQuery($c_sql);
        
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories','','*');
        
        $where = "pc.is_active=1";
        if (!empty($postData)) {
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['collection_method'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }

             if(!empty($f_date) & !empty($to_date)){      
                // $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $from_date . "' and pc.receive_date<='" . $to_date . "' and pc.payment_status='Received' order by pc.receive_date desc";
                // $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and  pc.payment_status='Received' and ((pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "') or (tdr.realization_date>='" . $f_date . "' and tdr.realization_date<='" . $to_date . "')) order by pc.receive_date desc";
                // $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and  pc.payment_status='Received' and (((pc.collection_method='Cash' or pc.collection_method='O.Cash') and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "') or (tdr.realization_date>='" . $f_date . "' and tdr.realization_date<='" . $to_date . "')) order by pc.receive_date desc";//17-10-2020
                //   $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and  pc.payment_status='Received' and (((pc.collection_method='Cash' or pc.collection_method='O.Cash') and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "') or (tdr.realization_date>='" . $f_date . "' and tdr.realization_date<='" . $to_date . "')) group by pc.id order by pc.receive_date desc,tdr.id desc";//18-10-2020
                 $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,(select realization_date from tbl_deposit_realization  where collection_id=pc.id and realization_status='Honored' limit 1) realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and  pc.payment_status='Received' and (((pc.collection_method='Cash' or pc.collection_method='O.Cash') and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "') or ((pc.collection_method='Pdc' or pc.collection_method='Lc' or pc.collection_method='Bg') and tdr.realization_status='Honored' and (tdr.realization_date>='" . $f_date . "' and tdr.realization_date<='" . $to_date . "'))) group by pc.id order by pc.receive_date desc,tdr.id desc";
                
             }else if (!empty($f_date)) {
              //  $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.receive_date>='" . $from_date .  "' and pc.is_active=1 and pc.payment_status='Received' order by pc.id desc"; 
                 $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date .  "' and pc.payment_status='Received' group by pc.id order by pc.receive_date desc,tdr.id desc"; 
             }else if (!empty($to_date)) {
              //  $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.receive_date<='" . $to_date .  "' and pc.is_active=1 and pc.payment_status='Received' order by pc.id desc";  
                 $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date<='" . $to_date .  "' and pc.payment_status='Received' group by pc.id order by pc.receive_date desc,tdr.id desc";  
             }else{
              //  $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.is_active=1 and pc.payment_status='Received' order by pc.id desc";   
              //$sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Received' order by pc.receive_date desc";      //17-10-2020
              //   $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Received' group by pc.id order by pc.receive_date desc,tdr.id desc";//18-10-2020
                 $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,(select realization_date from tbl_deposit_realization  where collection_id=pc.id and realization_status='Honored' limit 1) realization_date from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Received' group by pc.id order by pc.receive_date desc";
             }   
        }else{
           // $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.is_active=1 and pc.payment_status='Received' and pc.unit_id=" . $branch_id . ' order by pc.id desc';
           // $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where pc.is_active=1 and pc.payment_status='Received' group by pc.id order by pc.receive_date desc,tdr.id desc";//18-10-2020
            $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name,(select realization_date from tbl_deposit_realization  where collection_id=pc.id and realization_status='Honored' limit 1) realization_date from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where pc.is_active=1 and pc.payment_status='Received' group by pc.id order by pc.receive_date desc";
            $data['f_date'] = $f_date = '';
            $data['to_date'] = $to_date = '';
        }
        $data['collections'] = $this->m_common->customeQuery($sql);
        
        

        if ($print == false) {
            $this->load->view('sales_report/v_total_receive', $data);
        } else {
            $html = $this->load->view('sales_report/print_total_receive', $data, true);
            echo $html;
            exit;
        }
    }
    
    
    function totalReceivingReportExcel($print = false) {
        $this->load->library("PHPExcel");
        $postData = $this->input->post();
        $where = "pc.is_active=1";
        if (!empty($postData)) {
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['collection_method'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }

             if(!empty($f_date) & !empty($to_date)){      
                // $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $from_date . "' and pc.receive_date<='" . $to_date . "' and pc.payment_status='Received' order by pc.receive_date desc";
                // $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and  pc.payment_status='Received' and ((pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "') or (tdr.realization_date>='" . $f_date . "' and tdr.realization_date<='" . $to_date . "')) order by pc.receive_date desc";
                // $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and  pc.payment_status='Received' and (((pc.collection_method='Cash' or pc.collection_method='O.Cash') and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "') or (tdr.realization_date>='" . $f_date . "' and tdr.realization_date<='" . $to_date . "')) order by pc.receive_date desc";//17-10-2020
                //   $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and  pc.payment_status='Received' and (((pc.collection_method='Cash' or pc.collection_method='O.Cash') and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "') or (tdr.realization_date>='" . $f_date . "' and tdr.realization_date<='" . $to_date . "')) group by pc.id order by pc.receive_date desc,tdr.id desc";//18-10-2020
                 $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,(select realization_date from tbl_deposit_realization  where collection_id=pc.id and realization_status='Honored' limit 1) realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and  pc.payment_status='Received' and (((pc.collection_method='Cash' or pc.collection_method='O.Cash') and pc.receive_date>='" . $f_date . "' and pc.receive_date<='" . $to_date . "') or ((pc.collection_method='Pdc' or pc.collection_method='Lc' or pc.collection_method='Bg') and tdr.realization_status='Honored' and (tdr.realization_date>='" . $f_date . "' and tdr.realization_date<='" . $to_date . "'))) group by pc.id order by pc.receive_date desc,tdr.id desc";
                
             }else if (!empty($f_date)) {
              //  $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.receive_date>='" . $from_date .  "' and pc.is_active=1 and pc.payment_status='Received' order by pc.id desc"; 
                 $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $f_date .  "' and pc.payment_status='Received' group by pc.id order by pc.receive_date desc,tdr.id desc"; 
             }else if (!empty($to_date)) {
              //  $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.receive_date<='" . $to_date .  "' and pc.is_active=1 and pc.payment_status='Received' order by pc.id desc";  
                 $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date<='" . $to_date .  "' and pc.payment_status='Received' group by pc.id order by pc.receive_date desc,tdr.id desc";  
             }else{
              //  $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where $where and pc.is_active=1 and pc.payment_status='Received' order by pc.id desc";   
              //$sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Received' order by pc.receive_date desc";      //17-10-2020
              //   $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Received' group by pc.id order by pc.receive_date desc,tdr.id desc";//18-10-2020
                 $sql = "select pc.*,c.c_name,c.c_short_name,tpc.category_name,(select realization_date from tbl_deposit_realization  where collection_id=pc.id and realization_status='Honored' limit 1) realization_date from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Received' group by pc.id order by pc.receive_date desc";
             }   
        }else{
           // $sql = "select pc.*,c.c_name,c_short_name from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.is_active=1 and pc.payment_status='Received' and pc.unit_id=" . $branch_id . ' order by pc.id desc';
           // $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name,tdr.realization_date from tbl_payment_collections pc left join tbl_deposit_realization tdr on pc.id=tdr.collection_id left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where pc.is_active=1 and pc.payment_status='Received' group by pc.id order by pc.receive_date desc,tdr.id desc";//18-10-2020
            $sql = "select pc.*,c.c_name,c_short_name,tpc.category_name,(select realization_date from tbl_deposit_realization  where collection_id=pc.id and realization_status='Honored' limit 1) realization_date from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where pc.is_active=1 and pc.payment_status='Received' group by pc.id order by pc.receive_date desc";
            $data['f_date'] = $f_date = '';
            $data['to_date'] = $to_date = '';
        }
        $data['collections'] = $this->m_common->customeQuery($sql);


        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Total Receive');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:N3')->applyFromArray($style);

     //   $table_columns = array("SL", "S. Order", "Customer Name.", "Project", "Pdc/Lc/Bg No.", "Pdc/Lc/Bg Date", "Mat Date", "Bank", "Value");
        $table_columns = array("SL","Receive Date", "Customer Name.","MRR NO.","Product Type","Mode of Payment","Pdc/Lc/Bg No.","Remark", "Value");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setBold(true);


        $excel_row = 6;


        if (!empty($data['collections'])) {
            $total = 0;
            $i = 0;
            foreach ($data['collections'] as $collection) {
                $i++;
                $total = $total + $collection['amount'];
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                if($collection['collection_method']=="Cash" || $collection['collection_method']=="O.Cash"){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y',strtotime($collection['receive_date'])));
                }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y',strtotime($collection['realization_date'])));
                }   
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $collection['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $collection['mrr_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $collection['category_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $collection['collection_method']);
                if($collection['collection_method']=="Cash" || $collection['collection_method']=="O.Cash"){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, '');
                }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $collection['no']);
                }
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $collection['remark']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, round($collection['amount'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, 'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, round($total, 2));
        $object->getActiveSheet()->getStyle("J$excel_row:L$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("J$excel_row:L$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:N' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('Q6:N'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'N'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="total_receiving.xls"');
        $object_writer->save('php://output');
    }
    
    
    
    
    function realizedCheque($print = false){
        $this->menu='sales';
        $this->sub_inner_menu='sales_report';
        $this->titlebackend("Report");
        $postData = $this->input->post();
        
        $c_sql = "select c.* from tbl_deposit_realization tdr left join tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id  where pc.is_active=1 and tdr.realization_status='Honored' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') group by pc.customer_id order by c.c_name";
        $data['customers'] = $this->m_common->customeQuery($c_sql);
        
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories','','*');
        
        $where = "dr.is_active=1";
        if (!empty($postData)) {
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['collection_method'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] =$customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                //$data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                //$data['projects'] = '';
            }

             if(!empty($f_date) && !empty($to_date)){              
                  //$sql = "select dr.*,pc.receive_date,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date>='" . $f_date . "' and dr.realization_date<='" . $to_date . "' and dr.realization_status='Honored' order by dr.deposit_date DESC"; //10-10-2020
                  $sql = "select dr.*,pc.receive_date,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name,(select count(*) from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored') as dishonored_times,
                  (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
                  (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2 from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date>='" . $f_date . "' and dr.realization_date<='" . $to_date . "' and dr.realization_status='Honored' order by dr.deposit_date DESC";
             }else if (!empty($f_date)) {              
                 // $sql = "select dr.*,pc.receive_date,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date>='".$f_date."' and dr.realization_status='Honored' order by dr.deposit_date DESC"; //10-10-2020
                 $sql = "select dr.*,pc.receive_date,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name,(select count(*) from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored') as dishonored_times,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2 from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date>='".$f_date."' and dr.realization_status='Honored' order by dr.deposit_date DESC";
             }else if (!empty($to_date)) {               
                 // $sql = "select dr.*,pc.receive_date,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date<='" . $to_date . "' and dr.realization_status='Honored' order by dr.deposit_date DESC"; //10-10-2020
                 $sql = "select dr.*,pc.receive_date,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name,(select count(*) from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored') as dishonored_times,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2 from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date<='" . $to_date . "' and dr.realization_status='Honored' order by dr.deposit_date DESC";
             }else{                
                //  $sql = "select dr.*,pc.receive_date,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_status='Honored' order by dr.deposit_date DESC";//10-10-2020
                 $sql = "select dr.*,pc.receive_date,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name,(select count(*) from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored') as dishonored_times,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2 from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_status='Honored' order by dr.deposit_date DESC";
             }   
        }else{
            $sql = "select pc.*,tdr.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name,(select count(*) from tbl_deposit_realization as tdr1 
            LEFT JOIN tbl_payment_collections pc1
                          ON tdr1.collection_id = pc1.id 
            where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored') as dishonored_times,
            (select tdr1.realization_date from tbl_deposit_realization as tdr1 
            LEFT JOIN tbl_payment_collections pc1
                          ON tdr1.collection_id = pc1.id 
            where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
            (select tdr1.realization_date from tbl_deposit_realization as tdr1 
            LEFT JOIN tbl_payment_collections pc1
                          ON tdr1.collection_id = pc1.id 
            where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2 from tbl_deposit_realization tdr left join tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where pc.is_active=1 and tdr.realization_status='Honored' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') ";
        }
        $data['orders'] = $this->m_common->customeQuery($sql);
        
        

        if ($print == false) {
            $this->load->view('sales_report/v_realized_cheque', $data);
        } else {
            $html = $this->load->view('sales_report/print_realized_cheque', $data, true);
            echo $html;
            exit;
        }
    }
    
    
    function realizedChequeExcel($print = false) {
        $this->load->library("PHPExcel");
        $postData = $this->input->post();
        $where = "dr.is_active=1";
        if (!empty($postData)) {
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] =$customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                //$data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                //$data['projects'] = '';
            }

             if(!empty($f_date) & !empty($to_date)){              
                  $sql = "select dr.*,pc.receive_date,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name,(select count(*) from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored') as dishonored_times,
                  (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
                  (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2 from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date>='" . $f_date . "' and dr.realization_date<='" . $to_date . "' and dr.realization_status='Honored' order by dr.deposit_date DESC";
             }else if (!empty($f_date)) {              
                  $sql = "select dr.*,pc.receive_date,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name,(select count(*) from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored') as dishonored_times,
                  (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
                  (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2 from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date>='".$f_date."' and dr.realization_status='Honored' order by dr.deposit_date DESC";
             }else if (!empty($to_date)) {               
                  $sql = "select dr.*,pc.receive_date,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name,(select count(*) from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored') as dishonored_times,
                  (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
                  (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2 from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date<='" . $to_date . "' and dr.realization_status='Honored' order by dr.deposit_date DESC";
             }else{                
                  $sql = "select dr.*,pc.receive_date,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name,(select count(*) from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored') as dishonored_times,
                  (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
                  (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2 from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_status='Honored' order by dr.deposit_date DESC";
             }   
        }else{
            $sql = "select pc.*,tdr.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name,(select count(*) from tbl_deposit_realization as tdr1 
            LEFT JOIN tbl_payment_collections pc1
                          ON tdr1.collection_id = pc1.id 
            where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored') as dishonored_times,
            (select tdr1.realization_date from tbl_deposit_realization as tdr1 
            LEFT JOIN tbl_payment_collections pc1
                          ON tdr1.collection_id = pc1.id 
            where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
            (select tdr1.realization_date from tbl_deposit_realization as tdr1 
            LEFT JOIN tbl_payment_collections pc1
                          ON tdr1.collection_id = pc1.id 
            where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2 from tbl_deposit_realization tdr left join tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where pc.is_active=1 and tdr.realization_status='Honored' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') ";
        }
        $data['orders'] = $this->m_common->customeQuery($sql);


        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Honored Cheque/PO/BG');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:N3')->applyFromArray($style);

     //   $table_columns = array("SL", "S. Order", "Customer Name.", "Project", "Pdc/Lc/Bg No.", "Pdc/Lc/Bg Date", "Mat Date", "Bank", "Value");
        $table_columns = array("SL", "Customer Name.","Product Type","Collection Method","Pdc/Lc/Bg No.", "Deposit Date","Dishonor Date 1","Dishonor Date 2","Dishonor Times","Honor Date","Bank", "Value");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setBold(true);


        $excel_row = 6;


        if (!empty($data['orders'])) {
            $total = 0;
            $i = 0;
            foreach ($data['orders'] as $order) {
                $i++;
                $total = $total + $order['amount'];
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $order['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $order['category_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $order['collection_method']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $order['no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $order['deposit_date']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $order['dishonored1']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $order['dishonored2']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $order['dishonored_times']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $order['realization_date']);
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, $order['b_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, round($order['amount'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, 'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, round($total, 2));
        $object->getActiveSheet()->getStyle("J$excel_row:L$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("J$excel_row:L$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:Q' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('Q6:Q'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'Q'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="realize_cheque.xls"');
        $object_writer->save('php://output');
    }
    
    
    function dishonoredCheque($print = false){
        $this->menu='sales';
        $this->sub_inner_menu='sales_report';
        $this->titlebackend("Report");
        $postData = $this->input->post();
        
        $c_sql = "select c.* from tbl_deposit_realization tdr left join tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id  where pc.is_active=1 and tdr.realization_status='Dishonored' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') group by pc.customer_id ";
        $data['customers'] = $this->m_common->customeQuery($c_sql);
        
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories','','*');
        
        $where = "dr.is_active=1";
        if (!empty($postData)) {
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] =$customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                //$data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                //$data['projects'] = '';
            }

             if(!empty($f_date) & !empty($to_date)){              
                  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date>='" . $f_date . "' and dr.realization_date<='" . $to_date . "' and dr.realization_status='Dishonored' order by dr.deposit_date DESC";
             }else if (!empty($f_date)) {              
                  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date>='".$f_date."' and dr.realization_status='Dishonored' order by dr.deposit_date DESC";
             }else if (!empty($to_date)) {               
                  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date<='" . $to_date . "' and dr.realization_status='Dishonored' order by dr.deposit_date DESC";
             }else{                
                  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_status='Dishonored' order by dr.deposit_date DESC";
             }   
        }else{
            $sql = "select pc.*,tdr.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_deposit_realization tdr left join tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where pc.is_active=1 and tdr.realization_status='Dishonored' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') ";
        }
        $data['orders'] = $this->m_common->customeQuery($sql);
        
        

        if ($print == false) {
            $this->load->view('sales_report/v_dishonored_cheque', $data);
        } else {
            $html = $this->load->view('sales_report/print_dishonored_cheque', $data, true);
            echo $html;
            exit;
        }
    }
    
    
    function dishonoredChequeExcel($print = false) {
        $this->load->library("PHPExcel");
        $postData = $this->input->post();
        $where = "dr.is_active=1";
        if (!empty($postData)) {
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] =$customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                //$data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                //$data['projects'] = '';
            }

             if(!empty($f_date) & !empty($to_date)){              
                  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date>='" . $f_date . "' and dr.realization_date<='" . $to_date . "' and dr.realization_status='Dishonored' order by dr.deposit_date DESC";
             }else if (!empty($f_date)) {              
                  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date>='".$f_date."' and dr.realization_status='Dishonored' order by dr.deposit_date DESC";
             }else if (!empty($to_date)) {               
                  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date<='" . $to_date . "' and dr.realization_status='Dishonored' order by dr.deposit_date DESC";
             }else{                
                  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_status='Dishonored' order by dr.deposit_date DESC";
             }    
        }else{
            $sql = "select pc.*,tdr.*,c.c_name,c_short_name,b.b_name,b.b_short_name,b.branch_name,tpc.category_name from tbl_deposit_realization tdr left join tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where pc.is_active=1 and tdr.realization_status='Dishonored' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') ";
        }
        $data['orders'] = $this->m_common->customeQuery($sql);


        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Dishonored Cheque/PO/BG');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:N3')->applyFromArray($style);

     //   $table_columns = array("SL", "S. Order", "Customer Name.", "Project", "Pdc/Lc/Bg No.", "Pdc/Lc/Bg Date", "Mat Date", "Bank", "Value");
        $table_columns = array("SL", "Customer Name.","Product Type","Collection Method","Pdc/Lc/Bg No.", "Deposit Date","Dishonor Date","Bank", "Value");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setBold(true);


        $excel_row = 6;


        if (!empty($data['orders'])) {
            $total = 0;
            $i = 0;
            foreach ($data['orders'] as $order) {
                $i++;
                $total = $total + $order['amount'];
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $order['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $order['category_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $order['collection_method']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $order['no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $order['deposit_date']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $order['realization_date']);
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $order['b_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, round($order['amount'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, 'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, round($total, 2));
        $object->getActiveSheet()->getStyle("J$excel_row:L$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("J$excel_row:L$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:N'.$excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('L6:N'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for($col = 'F'; $col !== 'M'; $col++){
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer=PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="dishonored_cheque.xls"');
        $object_writer->save('php://output');
    }
    
    
    function dishonoredChequeAtHand($print = false){
        $this->menu='sales';
        $this->sub_inner_menu='sales_report';
        $this->titlebackend("Report");
        $postData = $this->input->post();
        
        $c_sql = "select c.* from tbl_deposit_realization tdr left join tbl_payment_collections pc on tdr.collection_id=pc.id left join tbl_banks b on tdr.bank_id=b.id  left join tbl_customers c on pc.customer_id=c.id  where pc.is_active=1 and tdr.realization_status='Dishonored' and (collection_method='Pdc' or collection_method='Lc' or collection_method='Bg' or collection_method='Po') group by pc.customer_id ";
        $data['customers'] = $this->m_common->customeQuery($c_sql);
        
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories','','*');
        
        $where = "pc.is_active=1";
        if (!empty($postData)) {
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] =$customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                //$data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                //$data['projects'] = '';
            }

             if(!empty($f_date) & !empty($to_date)){              
               //   $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date>='" . $f_date . "' and dr.realization_date<='" . $to_date . "' and dr.realization_status='Dishonored' order by dr.deposit_date DESC";
                 $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name,(select count(*) from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored') as dishonored_times,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 2,1) as dishonored3 from tbl_payment_collections pc left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.dishonor_date>='" . $f_date . "' and pc.dishonor_date<='" . $to_date . "' and pc.payment_status='Dishonored' order by pc.dishonor_date DESC";
             }else if (!empty($f_date)) {              
                //  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date>='".$f_date."' and dr.realization_status='Dishonored' order by dr.deposit_date DESC";
                $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name,(select count(*) from tbl_deposit_realization as tdr1 
                LEFT JOIN tbl_payment_collections pc1
                              ON tdr1.collection_id = pc1.id 
                where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored') as dishonored_times,
                (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                LEFT JOIN tbl_payment_collections pc1
                              ON tdr1.collection_id = pc1.id 
                where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
                (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                LEFT JOIN tbl_payment_collections pc1
                              ON tdr1.collection_id = pc1.id 
                where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2,
                (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                LEFT JOIN tbl_payment_collections pc1
                              ON tdr1.collection_id = pc1.id 
                where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 2,1) as dishonored3 from tbl_payment_collections pc left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.dishonor_date>='" . $f_date . "' and pc.payment_status='Dishonored' order by pc.dishonor_date DESC";
             }else if (!empty($to_date)) {               
                  //$sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date<='" . $to_date . "' and dr.realization_status='Dishonored' order by dr.deposit_date DESC";
                 $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name,(select count(*) from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored') as dishonored_times,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 2,1) as dishonored3 from tbl_payment_collections pc left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.dishonor_date<='" . $to_date . "' and pc.payment_status='Dishonored' order by pc.dishonor_date DESC";
             }else{                
                  $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name,(select count(*) from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored') as dishonored_times,
                  (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
                  (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2,
                  (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 2,1) as dishonored3 from tbl_payment_collections pc left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Dishonored' order by pc.dishonor_date DESC";
             }   
        }else{
            $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name,(select count(*) from tbl_deposit_realization as tdr1 
            LEFT JOIN tbl_payment_collections pc1
                          ON tdr1.collection_id = pc1.id 
            where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored') as dishonored_times,
            (select tdr1.realization_date from tbl_deposit_realization as tdr1 
            LEFT JOIN tbl_payment_collections pc1
                          ON tdr1.collection_id = pc1.id 
            where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
            (select tdr1.realization_date from tbl_deposit_realization as tdr1 
            LEFT JOIN tbl_payment_collections pc1
                          ON tdr1.collection_id = pc1.id 
            where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2,
            (select tdr1.realization_date from tbl_deposit_realization as tdr1 
            LEFT JOIN tbl_payment_collections pc1
                          ON tdr1.collection_id = pc1.id 
            where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 2,1) as dishonored3 from tbl_payment_collections pc left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Dishonored' order by pc.dishonor_date DESC";
        }
        $data['orders'] = $this->m_common->customeQuery($sql);
        
        

        if ($print == false) {
            $this->load->view('sales_report/v_dishonored_cheque_hand', $data);
        } else {
            $html = $this->load->view('sales_report/print_dishonored_cheque_hand', $data, true);
            echo $html;
            exit;
        }
    }
    
    
   function dishonoredChequeAtHandExcel($print = false) {
        $this->load->library("PHPExcel");
        $postData = $this->input->post();
        $where = "pc.is_active=1";
       if (!empty($postData)) {
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $category_id = $this->input->post('category_id');
            $collection_method = $this->input->post('collection_method');
            
            if (!empty($f_date) & !empty($to_date)) {
                $f_date = date('Y-m-d', strtotime($f_date));
                $to_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
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
            
            if (!empty($collection_method)) {
                $data['collection_method'] =$collection_method;
                if (empty($where)) {
                    $where .= "pc.collection_method='$collection_method'";
                } else {
                    $where .= " and pc.collection_method='$collection_method'";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($category_id)) {
                $data['category_id'] =$category_id;
                if (empty($where)) {
                    $where .= "pc.payment_for_id=$category_id";
                } else {
                    $where .= " and pc.payment_for_id=$category_id";
                }
               
            } else {
                $data['$category_id'] ='';
            }
            
            
            if (!empty($customer_id)) {
                $data['customer_id'] =$customer_id;
                if (empty($where)) {
                    $where .= "pc.customer_id=$customer_id";
                } else {
                    $where .= " and pc.customer_id=$customer_id";
                }
                //$data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                //$data['projects'] = '';
            }

             if(!empty($f_date) & !empty($to_date)){              
               //   $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date>='" . $f_date . "' and dr.realization_date<='" . $to_date . "' and dr.realization_status='Dishonored' order by dr.deposit_date DESC";
                 $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 2,1) as dishonored3 from tbl_payment_collections pc left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.dishonor_date>='" . $f_date . "' and pc.dishonor_date<='" . $to_date . "' and pc.payment_status='Dishonored' order by pc.dishonor_date DESC";
             }else if (!empty($f_date)) {              
                //  $sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date>='".$f_date."' and dr.realization_status='Dishonored' order by dr.deposit_date DESC";
                $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name,
                (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                LEFT JOIN tbl_payment_collections pc1
                              ON tdr1.collection_id = pc1.id 
                where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
                (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                LEFT JOIN tbl_payment_collections pc1
                              ON tdr1.collection_id = pc1.id 
                where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2,
                (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                LEFT JOIN tbl_payment_collections pc1
                              ON tdr1.collection_id = pc1.id 
                where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 2,1) as dishonored3 from tbl_payment_collections pc left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.dishonor_date>='" . $f_date . "' and pc.payment_status='Dishonored' order by pc.dishonor_date DESC";
             }else if (!empty($to_date)) {               
                  //$sql = "select dr.*,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and dr.realization_date<='" . $to_date . "' and dr.realization_status='Dishonored' order by dr.deposit_date DESC";
                 $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2,
                 (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                 LEFT JOIN tbl_payment_collections pc1
                               ON tdr1.collection_id = pc1.id 
                 where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 2,1) as dishonored3 from tbl_payment_collections pc left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.dishonor_date<='" . $to_date . "' and pc.payment_status='Dishonored' order by pc.dishonor_date DESC";
             }else{                
                  $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name,
                  (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
                  (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2,
                  (select tdr1.realization_date from tbl_deposit_realization as tdr1 
                  LEFT JOIN tbl_payment_collections pc1
                                ON tdr1.collection_id = pc1.id 
                  where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 2,1) as dishonored3 from tbl_payment_collections pc left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Dishonored' order by pc.dishonor_date DESC";
             }   
        }else{
            $sql = "select pc.*,tc.c_name,c_short_name,tpc.category_name,
            (select tdr1.realization_date from tbl_deposit_realization as tdr1 
            LEFT JOIN tbl_payment_collections pc1
                          ON tdr1.collection_id = pc1.id 
            where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1) as dishonored1,
            (select tdr1.realization_date from tbl_deposit_realization as tdr1 
            LEFT JOIN tbl_payment_collections pc1
                          ON tdr1.collection_id = pc1.id 
            where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 1,1) as dishonored2,
            (select tdr1.realization_date from tbl_deposit_realization as tdr1 
            LEFT JOIN tbl_payment_collections pc1
                          ON tdr1.collection_id = pc1.id 
            where pc.check_no=pc1.check_no and tdr1.realization_status='Dishonored' order by tdr1.realization_date limit 2,1) as dishonored3 from tbl_payment_collections pc left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.payment_status='Dishonored' order by pc.dishonor_date DESC";
        }
        $data['orders'] = $this->m_common->customeQuery($sql);


        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Dishonored Cheque/PO/BG');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:N3')->applyFromArray($style);

     //   $table_columns = array("SL", "S. Order", "Customer Name.", "Project", "Pdc/Lc/Bg No.", "Pdc/Lc/Bg Date", "Mat Date", "Bank", "Value");
        $table_columns = array("SL", "Customer Name.","Product Type","Collection Method","Pdc/Lc/Bg No.","Dishonor Date 1","Dishonor Date 2","Dishonor Date 3","Value");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setBold(true);


        $excel_row = 6;


        if (!empty($data['orders'])) {
            $total = 0;
            $i = 0;
            foreach ($data['orders'] as $order) {
                $i++;
                $total = $total + $order['amount'];
                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $order['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $order['category_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $order['collection_method']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $order['no']);
               
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $order['dishonored1']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $order['dishonored2']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $order['dishonored3']);
                
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, round($order['amount'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, 'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, round($total, 2));
        $object->getActiveSheet()->getStyle("J$excel_row:L$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("J$excel_row:L$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:N'.$excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('L6:N'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for($col = 'F'; $col !== 'O'; $col++){
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer=PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="dishonored_cheque_at_hand.xls"');
        $object_writer->save('php://output');
    }
    

    function deliveredOrdersWithoutPayment($print = false) {
        $this->menu = 'sales';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $sql = "select do.*,c.c_name,c_short_name,so.order_no,so.sale_order_date from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where do.is_active=1 and do.do_status='Approved' and (do.status='Delivered' or do.status='Partially Delivered') and so.receive_status='Pending' order by so.sale_order_date DESC";
        $data['orders'] = $this->m_common->customeQuery($sql);
        if ($print == false) {
            $this->load->view('sales_report/v_d_orders_without_payment', $data);
        } else {
            $html = $this->load->view('sales_report/print_d_orders_without_payment', $data, true);
            echo $html;
            exit;
        }
    }

    function deliveredOrdersWithoutPaymentExcel($print = false) {
        $this->load->library("PHPExcel");
        $sql = "select do.*,c.c_name,c_short_name,so.order_no,so.sale_order_date from tbl_delivery_orders do left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id  where do.is_active=1 and do.do_status='Approved' and (do.status='Delivered' or do.status='Partially Delivered') and so.receive_status='Pending' order by so.sale_order_date DESC";
        $data['orders'] = $this->m_common->customeQuery($sql);

        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Delivered Sales Orders(Without Payment)');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:K3')->applyFromArray($style);

        $table_columns = array("SL", "Date", "S. Order No.", "Customer Name", "Project", "Value");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:K5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:K5')->getFont()->setBold(true);


        $excel_row = 6;


        if (!empty($data['orders'])) {
            $total = 0;
            $t_received = 0;
            $t_due = 0;
            $i = 0;
            foreach ($data['orders'] as $order) {
                $i++;
                $total = $total + $order['total_amount'];

                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y', strtotime($order['sale_order_date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $order['order_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $order['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $order['project_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, round($order['total_amount'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row,round($total, 2));
        $object->getActiveSheet()->getStyle("J$excel_row:N$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("J$excel_row:N$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:K' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('K6:K'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'K'; $col++) {
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="report.xls"');
        $object_writer->save('php://output');
    }
    
    
    function customerBalanceReport($print=false){
        $data['all_customers']=$this->m_common->get_row_array('tbl_customers','','*','','','c_name','asc');
        $customer_id = $this->input->post('customer_id');
        if(!empty($customer_id)){
            $data['customers']=$this->m_common->get_row_array('tbl_customers',array('id'=>$customer_id),'*');
            $data['customer_id']=$customer_id;
        }else{
            $data['customers']=$this->m_common->get_row_array('tbl_customers','','*');
            $data['customer_id']='';
        }
        foreach($data['customers'] as $key=>$value){
            $total_received=array();
            $total_adj_received=array();
            $total_vat_received=array();
            $total_ait_received=array();
            $id=$value['id'];
            
            $t_re_adj ="select sum(amount) as total_adj_amount from tbl_payment_collections pc  where pc.is_active=1 and collection_method='Adjustment' and pc.payment_status='Received' and pc.customer_id=".$id;
            $total_adj_received= $this->m_common->customeQuery($t_re_adj);
            
            
            $t_re_vat ="select sum(amount) as total_vat_amount from tbl_payment_collections pc  where pc.is_active=1 and collection_method='Vat' and pc.payment_status='Received' and pc.customer_id=".$id;
            $total_vat_received= $this->m_common->customeQuery($t_re_vat);
            
            $t_re_ait ="select sum(amount) as total_ait_amount from tbl_payment_collections pc  where pc.is_active=1 and collection_method='Ait' and pc.payment_status='Received' and pc.customer_id=".$id;
            $total_ait_received= $this->m_common->customeQuery($t_re_ait);
            
            
            
            $t_re ="select sum(amount) as total_amount from tbl_payment_collections pc  where pc.is_active=1 and pc.payment_status='Received' and pc.customer_id=".$id;
            $total_received= $this->m_common->customeQuery($t_re);
           // $deposit=$total_received[0]['total_amount']+$value['opening_balance']; 
            $data['customers'][$key]['adjustment']=$total_adj_received[0]['total_adj_amount'];
            $data['customers'][$key]['vat']=$total_vat_received[0]['total_vat_amount'];
            $data['customers'][$key]['ait']=$total_ait_received[0]['total_ait_amount'];
            $data['customers'][$key]['payment_received']=($total_received[0]['total_amount']+$value['opening_balance'])-($total_adj_received[0]['total_adj_amount']+$total_vat_received[0]['total_vat_amount']+$total_ait_received[0]['total_ait_amount']); 

            $data['customers'][$key]['deposit']=$total_received[0]['total_amount']+$value['opening_balance']; 

            $tb_sql="select sum(total_amount) as total_bill from tbl_sales_invoices v where v.status!='Canceled' and v.is_active=1 and v.customer_id=".$id;
            $total_bill=$this->m_common->customeQuery($tb_sql);
            $data['customers'][$key]['total_bill']=$total_bill[0]['total_bill']; 
            if(empty($data['customers'][$key]['deposit']) && empty($total_bill[0]['total_bill'])){
                unset($data['customers'][$key]);
            }

//            $hand_sql = "select sum(pc.amount) as total_amount from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.is_active=1 and (pc.payment_status='Collected' || pc.payment_status='Deposited' || pc.payment_status='Dishonored') and pc.customer_id=".$id;
//            $in_hand = $this->m_common->customeQuery($hand_sql);
//            $data['in_hand'] = $in_hand[0]['total_amount'];
        }
        if ($print == false) {
            $this->load->view('sales_report/v_customer_balance_report', $data);
        } else {
            $html = $this->load->view('sales_report/print_customer_balance', $data, true);
            echo $html;
            exit;
        }
    }

    function customerBalanceExcell($print = false) {
        $this->load->library("PHPExcel");
        $postData = $this->input->post();
        
        if (!empty($postData)) {
            
            $customer_id = $this->input->post('customer_id');
            if(!empty($customer_id)){
                $data['customers']=$this->m_common->get_row_array('tbl_customers',array('id'=>$customer_id),'*');
                $data['customer_id']=$customer_id;
            }else{
                $data['customers']=$this->m_common->get_row_array('tbl_customers','','*');
                $data['customer_id']='';
            }
            foreach($data['customers'] as $key=>$value){
                $total_received=array();
                $total_adj_received=array();
                $total_vat_received=array();
                $total_ait_received=array();
                $id=$value['id'];

                $t_re_adj ="select sum(amount) as total_adj_amount from tbl_payment_collections pc  where pc.is_active=1 and collection_method='Adjustment' and pc.payment_status='Received' and pc.customer_id=".$id;
                $total_adj_received= $this->m_common->customeQuery($t_re_adj);


                $t_re_vat ="select sum(amount) as total_vat_amount from tbl_payment_collections pc  where pc.is_active=1 and collection_method='Vat' and pc.payment_status='Received' and pc.customer_id=".$id;
                $total_vat_received= $this->m_common->customeQuery($t_re_vat);

                $t_re_ait ="select sum(amount) as total_ait_amount from tbl_payment_collections pc  where pc.is_active=1 and collection_method='Ait' and pc.payment_status='Received' and pc.customer_id=".$id;
                $total_ait_received= $this->m_common->customeQuery($t_re_ait);



                $t_re ="select sum(amount) as total_amount from tbl_payment_collections pc  where pc.is_active=1 and pc.payment_status='Received' and pc.customer_id=".$id;
                $total_received= $this->m_common->customeQuery($t_re);
               // $deposit=$total_received[0]['total_amount']+$value['opening_balance']; 
                $data['customers'][$key]['adjustment']=$total_adj_received[0]['total_adj_amount'];
                $data['customers'][$key]['vat']=$total_vat_received[0]['total_vat_amount'];
                $data['customers'][$key]['ait']=$total_ait_received[0]['total_ait_amount'];
                $data['customers'][$key]['payment_received']=($total_received[0]['total_amount']+$value['opening_balance'])-($total_adj_received[0]['total_adj_amount']+$total_vat_received[0]['total_vat_amount']+$total_ait_received[0]['total_ait_amount']); 
                $data['customers'][$key]['deposit']=$total_received[0]['total_amount']+$value['opening_balance']; 

                $tb_sql="select sum(total_amount) as total_bill from tbl_sales_invoices v where v.status!='Canceled' and v.is_active=1 and v.customer_id=".$id;
                $total_bill=$this->m_common->customeQuery($tb_sql);
                $data['customers'][$key]['total_bill']=$total_bill[0]['total_bill']; 
                if(empty($data['customers'][$key]['deposit']) && empty($total_bill[0]['total_bill'])){
                    unset($data['customers'][$key]);
                }

    //            $hand_sql = "select sum(pc.amount) as total_amount from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id where pc.is_active=1 and pc.payment_status!='Received' and pc.customer_id=".$id;
    //            $in_hand = $this->m_common->customeQuery($hand_sql);
    //            $data['in_hand'] = $in_hand[0]['total_amount'];
            }


            $object = new PHPExcel();
            $object->setActiveSheetIndex(0);
            $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
            $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
            $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
            $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2,'Customer Balance Report');
           
            $style = array(
                'alignment' => array(
                    'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                )
            );
            $object->getActiveSheet()->getStyle('I1:N3')->applyFromArray($style);

         //   $table_columns = array("SL", "S. Order", "Customer Name.", "Project", "Pdc/Lc/Bg No.", "Pdc/Lc/Bg Date", "Mat Date", "Bank", "Value");
            $table_columns = array("SL", "Customer Name","Adjustment","Vat","Ait","Payment Received","Total Deposit","Total Bill","Due", "Surplus");

            $column = 5;

            foreach ($table_columns as $field) {
                $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
                $column++;
            }
            $object->getActiveSheet()->getStyle('F5:O5')->getFont()->setSize('12');
            $object->getActiveSheet()->getStyle('F5:O5')->getFont()->setBold(true);


            $excel_row = 6;


            if (!empty($data['customers'])) {
                $total=0;
                $net_bill=0;
                $net_due=0;
                $net_balance=0;
                
                $total_adj=0;
                $total_vat=0;
                $total_ait=0;
                $total_payment_received=0;
                
                $i = 0;
                foreach ($data['customers'] as $cust) {
                    $total_adj=$total_adj+$cust['adjustment'];
                    $total_vat=$total_vat+$cust['vat'];
                    $total_ait=$total_ait+$cust['ait'];
                    $total_payment_received=$total_payment_received+$cust['payment_received'];
                    
                    $total=$total+$cust['deposit'];
                    $net_bill=$net_bill+$cust['total_bill'];
                    $due=$cust['total_bill']-$cust['deposit'];
                    if($due>0){
                        $net_due=$net_due+$due;
                    }else{
                      $net_balance=$net_balance+($cust['deposit']-$cust['total_bill']);  
                    }
                    
                    $i++;
                    
                    $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);

                    $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $cust['c_name']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $cust['adjustment']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $cust['vat']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $cust['ait']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $cust['payment_received']);
                    
                    $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $cust['deposit']);
                    $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $cust['total_bill']);
                    if($due>0){
                        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $due);
                    }else{
                        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row,'');
                    }
                    if($due<0){
                        $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row,($cust['deposit']-$cust['total_bill']));
                    }else{
                        $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row,'');
                    }
                   

                    $excel_row++;
                }
            }
            $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, 'Total');
            $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row,$total_adj);
            $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row,$total_vat);
            $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row,$total_ait);
            $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row,$total_payment_received);
            $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row,$total);
            $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row,$net_bill);
            $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row,$net_due);
            $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row,$net_balance);
            $object->getActiveSheet()->getStyle("H$excel_row:O$excel_row")->getFont()->setSize('12');
            $object->getActiveSheet()->getStyle("H$excel_row:O$excel_row")->getFont()->setBold(true);

            $styleArray = array(
                'borders' => array(
                    'allborders' => array(
                        'style' => PHPExcel_Style_Border::BORDER_THIN
                    )
                )
            );

            $object->getActiveSheet()->getStyle('F5:O'.$excel_row)->applyFromArray($styleArray);
            $object->getActiveSheet()->getStyle('H6:O'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

            // Auto size columns for each worksheet
            for($col = 'F'; $col !== 'O'; $col++){
                $object->getActiveSheet()
                        ->getColumnDimension($col)
                        ->setAutoSize(true);
            }

            $object_writer=PHPExcel_IOFactory::createWriter($object, 'Excel5');
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="customer_balance.xls"');
            $object_writer->save('php://output');
    }
    
    }
    
    
    
    
    
    function project_info() {
        $this->setOutputMode(NORMAL);
        $customer_id = $this->input->post('customer_id');

        $data['data'] = $this->m_common->get_row_array('tbl_project', array('customer_id' => $customer_id), '*');
        $data['order_info'] = $this->m_common->get_row_array('tbl_sales_orders', array('customer_id' => $customer_id), '*');
        echo json_encode($data);
    }

    function salesOrderInfoProjectWise() {
        $this->setOutputMode(NORMAL);
        $project_id = $this->input->post('project_id');
        $data['order_info'] = $this->m_common->get_row_array('tbl_sales_orders', array('project_id' => $project_id), '*');
        echo json_encode($data);
    }

    function deliveryOrderInfoSaleOrderWise() {
        $this->setOutputMode(NORMAL);
        $o_id = $this->input->post('o_id');
        $data['order_info'] = $this->m_common->get_row_array('tbl_delivery_orders', array('o_id' => $o_id), '*');
        echo json_encode($data);
    }

    function salesCommission($print = false)
    {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $b_id = $this->input->post('branch_id');
        if (!empty($b_id)) {
            $branch_id = $b_id;
        } else {
            $branch_id = $this->session->userdata('companyId');
        }
        $data['employees'] = $this->m_common->get_row_array('employees', '', '*');
        $data['product_categories'] = $this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');

        $data['branches'] = $this->m_common->get_row_array('department', '', '*');
        $where = '';

        // $where .="tsi.unit_id=".$branch_id;
        $where .= "tsi.is_active=1";
        $postData = $this->input->post();
        if (!empty($postData)) {
            $b_id = $this->input->post('branch_id');
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $category_id = $this->input->post('category_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $bill_status = $this->input->post('bill_status');
            $s_p_id = $this->input->post('sale_person_id');

            if (!empty($b_id)) {
                $data['branch_id'] = $b_id;
                if (empty($where)) {
                    // $where .= "so.customer_id=$customer_id";
                    $where .= "tsi.unit_id=$b_id";
                } else {
                    //$where .= " and so.customer_id=$customer_id";
                    $where .= " and tsi.unit_id=$b_id";
                }
            } else {
                $data['branch_id'] = '';
            }



            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    // $where .= "so.customer_id=$customer_id";
                    $where .= "tsi.customer_id=$customer_id";
                } else {
                    //$where .= " and so.customer_id=$customer_id";
                    $where .= " and tsi.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }


            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "tsi.category_id=$category_id";
                } else {
                    $where .= " and tsi.category_id=$category_id";
                }
            } else {
                $data['category_id'] = '';
            }

            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    // $where .= "so.project_id=$project_id";
                    $where .= "tsi.project_id=$project_id";
                } else {
                    $where .= " and tsi.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "so.o_id=$order_id";
                } else {
                    $where .= " and so.o_id=$order_id";
                }
            }


            if (!empty($s_p_id)) {
                $data['sale_person_id'] = $s_p_id;
                if (empty($where)) {
                    $where .= "so.sale_person_id=$s_p_id";
                } else {
                    $where .= " and so.sale_person_id=$s_p_id";
                }
            } else {
                $data['sale_person_id'] = '';
            }


            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $too_date = date('t-m-Y');
            }


            if (!empty($f_date) & !empty($to_date)) {
                // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.is_active=1 and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
                // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name,tsp.product_name,sod.commission,sod.com_paid from tbl_sales_invoice_details as tsid left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsid.amount>0 and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' group by tsid.inv_id,tsid.s_item_id order by tsi.sale_invoice_date ASC";
            } else if (!empty($f_date)) {
                // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name,tsp.product_name,sod.commission,sod.com_paid from tbl_sales_invoice_details as tsid left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsid.amount>0 and tsi.sale_invoice_date>='" . $from_date . "' group by tsid.inv_id,tsid.s_item_id order by tsi.sale_invoice_date ASC";
            } else if (!empty($to_date)) {
                // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name,tsp.product_name,sod.commission,sod.com_paid from tbl_sales_invoice_details as tsid left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsid.amount>0 and tsi.sale_invoice_date<='" . $too_date . "' group by tsid.inv_id,tsid.s_item_id order by tsi.sale_invoice_date ASC";
            } else {
                //  $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
                //  $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1"; //2021-02-14
                $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name,tsp.product_name,sod.commission,sod.com_paid from tbl_sales_invoice_details as tsid left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where is_active=1 and tsid.amount>0 group by tsid.inv_id,tsid.s_item_id order by tsi.sale_invoice_date ASC";
            }
           // echo $sql;exit;
            $data['invoices'] = $this->m_common->customeQuery($sql);

            // foreach($data['invoices'] as $key=>$value){
            //   //  $s_d="select sum(quantity) as total_amount,unit_price,mu_name from tbl_sales_invoice_details where amount>0 and inv_id=".$value['inv_id'];
            //     $s_d="select sum(quantity) as total_amount,unit_price,mu_name,tsp.product_name,tsid.commission from tbl_sales_invoice_details tsid left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id  where amount>0 and inv_id=".$value['inv_id'];
            //     $t_amount=$this->m_common->customeQuery($s_d);
            //     $data['invoices'][$key]['total_qty']=$t_amount[0]['total_amount'];
            //     $data['invoices'][$key]['unit_price']=$t_amount[0]['unit_price'];
            //     $data['invoices'][$key]['mu_name']=$t_amount[0]['mu_name'];
            //     $data['invoices'][$key]['product_name']=$t_amount[0]['product_name'];
            //     $data['invoices'][$key]['commission']=$t_amount[0]['commission'];

            // }

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $too_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            if (!empty($f_date) & !empty($to_date)) {
                // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.is_active=1 and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
                // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name,tsp.product_name,sod.commission,sod.com_paid from tbl_sales_invoice_details as tsid left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsid.unit_price>0 and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' group by tsid.inv_id,tsid.s_item_id  order by tsi.sale_invoice_date ASC";
            } else if (!empty($f_date)) {
                // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name,tsp.product_name,sod.commission,sod.com_paid from tbl_sales_invoice_details as tsid left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsid.unit_price>0 and tsi.sale_invoice_date>='" . $from_date . "'  group by tsid.inv_id,tsid.s_item_id order by tsi.sale_invoice_date ASC";
            } else if (!empty($to_date)) {
                // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name,tsp.product_name,sod.commission,sod.com_paid from tbl_sales_invoice_details as tsid left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsid.unit_price>0 and tsi.sale_invoice_date<='" . $too_date . "'  group by tsid.inv_id,tsid.s_item_id order by tsi.sale_invoice_date ASC";
            } else {
                //  $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
                //  $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1"; //2021-02-14
                $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name,tsp.product_name,sod.commission,sod.com_paid from tbl_sales_invoice_details as tsid left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where is_active=1 and tsid.unit_price>0 group by tsid.inv_id,tsid.s_item_id order by tsi.sale_invoice_date ASC";
            }
            //  echo $sql;exit;
            $data['invoices'] = $this->m_common->customeQuery($sql);

            // foreach($data['invoices'] as $key=>$value){
            //     $s_d="select sum(quantity) as total_amount,unit_price,mu_name,tsp.product_name,sod.commission from tbl_sales_invoice_details tsid left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id where amount>0 and inv_id=".$value['inv_id'];
            //     $t_amount=$this->m_common->customeQuery($s_d);
            //     $data['invoices'][$key]['total_qty']=$t_amount[0]['total_amount'];
            //     $data['invoices'][$key]['unit_price']=$t_amount[0]['unit_price'];
            //     $data['invoices'][$key]['mu_name']=$t_amount[0]['mu_name'];
            //     $data['invoices'][$key]['product_name']=$t_amount[0]['product_name'];
            //     $data['invoices'][$key]['commission']=$t_amount[0]['commission'];

            // }
        }




        if ($print == false) {
            $this->load->view('sales_report/v_invoice_commission_report', $data);
        } else {
            $html = $this->load->view('sales_report/print_invoice_commission_report', $data, true);
            echo $html;
            exit;
        }
    }


    function salesCommissionExcel($print = false)
    {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $b_id = $this->input->post('branch_id');
        if (!empty($b_id)) {
            $branch_id = $b_id;
        } else {
            $branch_id = $this->session->userdata('companyId');
        }
        $data['employees'] = $this->m_common->get_row_array('employees', '', '*');
        $data['product_categories'] = $this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');

        $data['branches'] = $this->m_common->get_row_array('department', '', '*');
        $where = '';

        // $where .="tsi.unit_id=".$branch_id;
        $where .= "tsi.is_active=1";
        $postData = $this->input->post();
        if (!empty($postData)) {
            $b_id = $this->input->post('branch_id');
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $category_id = $this->input->post('category_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $bill_status = $this->input->post('bill_status');
            $s_p_id = $this->input->post('sale_person_id');

            if (!empty($b_id)) {
                $data['branch_id'] = $b_id;
                if (empty($where)) {
                    // $where .= "so.customer_id=$customer_id";
                    $where .= "tsi.unit_id=$b_id";
                } else {
                    //$where .= " and so.customer_id=$customer_id";
                    $where .= " and tsi.unit_id=$b_id";
                }
            } else {
                $data['branch_id'] = '';
            }



            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    // $where .= "so.customer_id=$customer_id";
                    $where .= "tsi.customer_id=$customer_id";
                } else {
                    //$where .= " and so.customer_id=$customer_id";
                    $where .= " and tsi.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }


            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "tsi.category_id=$category_id";
                } else {
                    $where .= " and tsi.category_id=$category_id";
                }
            } else {
                $data['category_id'] = '';
            }

            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    // $where .= "so.project_id=$project_id";
                    $where .= "tsi.project_id=$project_id";
                } else {
                    $where .= " and tsi.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "so.o_id=$order_id";
                } else {
                    $where .= " and so.o_id=$order_id";
                }
            }


            if (!empty($s_p_id)) {
                $data['sale_person_id'] = $s_p_id;
                if (empty($where)) {
                    $where .= "so.sale_person_id=$s_p_id";
                } else {
                    $where .= " and so.sale_person_id=$s_p_id";
                }
            } else {
                $data['sale_person_id'] = '';
            }


            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $too_date = date('t-m-Y');
            }


            if (!empty($f_date) & !empty($to_date)) {
                // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.is_active=1 and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
                // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name,tsp.product_name,sod.commission,sod.com_paid from tbl_sales_invoice_details as tsid left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsid.unit_price>0 and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' group by tsid.inv_id,tsid.s_item_id order by tsi.sale_invoice_date ASC";
            } else if (!empty($f_date)) {
                // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name,tsp.product_name,sod.commission,sod.com_paid from tbl_sales_invoice_details as tsid left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsid.unit_price>0 and tsi.sale_invoice_date>='" . $from_date . "' group by tsid.inv_id,tsid.s_item_id order by tsi.sale_invoice_date ASC";
            } else if (!empty($to_date)) {
                // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name,tsp.product_name,sod.commission,sod.com_paid from tbl_sales_invoice_details as tsid left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsid.unit_price>0 and tsi.sale_invoice_date<='" . $too_date . "' group by tsid.inv_id,tsid.s_item_id order by tsi.sale_invoice_date ASC";
            } else {
                //  $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
                //  $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1"; //2021-02-14
                $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name,tsp.product_name,sod.commission,sod.com_paid from tbl_sales_invoice_details as tsid left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where is_active=1 and tsid.unit_price>0 group by tsid.inv_id,tsid.s_item_id order by tsi.sale_invoice_date ASC";
            }
            $data['invoices'] = $this->m_common->customeQuery($sql);

            // foreach($data['invoices'] as $key=>$value){
            //   //  $s_d="select sum(quantity) as total_amount,unit_price,mu_name from tbl_sales_invoice_details where amount>0 and inv_id=".$value['inv_id'];
            //     $s_d="select sum(quantity) as total_amount,unit_price,mu_name,tsp.product_name,tsid.commission from tbl_sales_invoice_details tsid left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id  where amount>0 and inv_id=".$value['inv_id'];
            //     $t_amount=$this->m_common->customeQuery($s_d);
            //     $data['invoices'][$key]['total_qty']=$t_amount[0]['total_amount'];
            //     $data['invoices'][$key]['unit_price']=$t_amount[0]['unit_price'];
            //     $data['invoices'][$key]['mu_name']=$t_amount[0]['mu_name'];
            //     $data['invoices'][$key]['product_name']=$t_amount[0]['product_name'];
            //     $data['invoices'][$key]['commission']=$t_amount[0]['commission'];

            // }

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $too_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            if (!empty($f_date) & !empty($to_date)) {
                // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.is_active=1 and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
                // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name,tsp.product_name,sod.commission,sod.com_paid from tbl_sales_invoice_details as tsid left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsid.unit_price>0 and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' group by tsid.inv_id,tsid.s_item_id  order by tsi.sale_invoice_date ASC";
            } else if (!empty($f_date)) {
                // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name,tsp.product_name,sod.commission,sod.com_paid from tbl_sales_invoice_details as tsid left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsid.unit_price>0 and tsi.sale_invoice_date>='" . $from_date . "'  group by tsid.inv_id,tsid.s_item_id order by tsi.sale_invoice_date ASC";
            } else if (!empty($to_date)) {
                // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name,tsp.product_name,sod.commission,sod.com_paid from tbl_sales_invoice_details as tsid left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsid.unit_price>0 and tsi.sale_invoice_date<='" . $too_date . "'  group by tsid.inv_id,tsid.s_item_id order by tsi.sale_invoice_date ASC";
            } else {
                //  $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
                //  $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1"; //2021-02-14
                $sql = "select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name,so.o_id,sum(tsid.quantity) as total_qty,tsid.unit_price,tsid.mu_name,tsp.product_name,sod.commission,sod.com_paid from tbl_sales_invoice_details as tsid left join tbl_sales_invoices as tsi on tsid.inv_id=tsi.inv_id left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_order_details sod on so.o_id=sod.o_id and sod.product_id=tsid.s_item_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where is_active=1 and tsid.unit_price>0 group by tsid.inv_id,tsid.s_item_id order by tsi.sale_invoice_date ASC";
            }
            //  echo $sql;exit;
            $data['invoices'] = $this->m_common->customeQuery($sql);

            // foreach($data['invoices'] as $key=>$value){
            //     $s_d="select sum(quantity) as total_amount,unit_price,mu_name,tsp.product_name,sod.commission from tbl_sales_invoice_details tsid left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id where amount>0 and inv_id=".$value['inv_id'];
            //     $t_amount=$this->m_common->customeQuery($s_d);
            //     $data['invoices'][$key]['total_qty']=$t_amount[0]['total_amount'];
            //     $data['invoices'][$key]['unit_price']=$t_amount[0]['unit_price'];
            //     $data['invoices'][$key]['mu_name']=$t_amount[0]['mu_name'];
            //     $data['invoices'][$key]['product_name']=$t_amount[0]['product_name'];
            //     $data['invoices'][$key]['commission']=$t_amount[0]['commission'];

            // }
        }


        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Invoice Commission Report');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:Q3')->applyFromArray($style);

        // $table_columns = array("SL", "Invoice Date", "Inv. No.", "So.No.",  "C.Name", "Project","Amount","Paid Amount","Due Amount");
        // $table_columns = array("SL", "Invoice Date", "Inv. No.", "So.No.",  "C.Name", "Project","Product Name",'M.U.',"Quantity","Rate","Amount","Paid Amount","Due Amount"); //2021-02-14
        $table_columns = array("SL", "Invoice Date", "Inv. No.", "So.No.",  "C.Name", "Project", "Product Name", 'M.U.', "Quantity", "Rate", "Amount", "Paid Amount", "Due Amount", 'Commission','Commission Paid','Commission Due', "Sales Person");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setBold(true);


        $excel_row = 6;
        if (!empty($data['invoices'])) {
            $total_qty = 0;
            $total = 0;
            $total_received = 0;
            $total_due = 0;
            $total_comm = 0;
            $total_com_paid = 0;
            $total_com_due = 0;
            $i = 0;
            foreach ($data['invoices'] as $invoice) {
                $due = 0;
                $total_qty = $total_qty + $invoice['total_qty'];
                $total = $total + $invoice['total_amount'];
                $total_received = $total_received + $invoice['received_amount'];
                $i++;

                $due = $invoice['total_amount'] - $invoice['received_amount'];
                $due_qty = $due/$invoice['unit_price'];
                $total_due = $total_due + $due;
                $total_comm += abs($invoice['commission']*($invoice['total_qty']-$due_qty));
                $total_com_paid += $invoice['com_paid'];
                $total_com_due += abs($invoice['commission']*($invoice['total_qty']-$due_qty))-$invoice['com_paid'];

                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, date('d-m-Y', strtotime($invoice['sale_invoice_date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $invoice['inv_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, $invoice['order_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $invoice['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $invoice['project_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $invoice['product_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, $invoice['mu_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, $invoice['total_qty']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, $invoice['unit_price']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, round($invoice['total_amount'], 2));
                if (!empty($invoice['received_amount'])) {
                    $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, round($invoice['received_amount'], 2));
                } else {
                    $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, '');
                }
                if (!empty($due)) {
                    $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, round($due, 2));
                } else {
                    $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, '');
                }

                $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, round(abs($invoice['commission']*($invoice['total_qty']-$due_qty)), 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, round($invoice['com_paid'], 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(20, $excel_row, round(abs($invoice['commission']*($invoice['total_qty']-$due_qty))-$invoice['com_paid'], 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, $invoice['name']);
                //                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, number_format($invoice['quantity'], 2));
                //                $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, number_format($invoice['truck_no'], 2));
                //                $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, number_format($invoice['driver_name'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, 'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, round($total_qty, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, '');
        $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, round($total, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, round($total_received, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, round($total_due, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row, round($total_comm, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(19, $excel_row, round($total_com_paid, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(20, $excel_row, round($total_com_due, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(21, $excel_row, '');

        $object->getActiveSheet()->getStyle("L$excel_row:Q$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("L$excel_row:Q$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:T' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('M6:R' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'Q'; $col++) {
            $object->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="invoiceCommissioneport.xls"');
        $object_writer->save('php://output');
    }

    function castingWiseConsumption($print = false)
    {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Castingwise Consumption Report");
        $b_id = $this->input->post('branch_id');
        if (!empty($b_id)) {
            $branch_id = $b_id;
        } else {
            $branch_id = $this->session->userdata('companyId');
        }
        $data['employees'] = $this->m_common->get_row_array('employees', '', '*');
        $data['product_categories'] = $this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*');
        $where = '';
        $postData = $this->input->post();
        if (!empty($postData)) {
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $category_id = $this->input->post('category_id');
            $sale_person_id = $this->input->post('sale_person_id');
            $data['sale_person_id'] = $sale_person_id;
            $data['category_id'] = $category_id;


            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $to_date = date('t-m-Y');
            }
            if (!empty($sale_person_id)) {
                $where .= " and so.sale_person_id in(" . $sale_person_id . ")";
            }
            if (!empty($category_id)) {
                $where .= " and sp.category_id ='" . $category_id . "'";
            }

            $sql="select tpmd.*,tpm.casting_size,tpm.casting_size_cft,tpm.pm_no,tpm.created_date,tsp.product_name,tdo.delivery_no,i.item_name 
            from tbl_production_mixing_details as tpmd 
            left join tbl_production_mixing tpm on tpmd.pm_id=tpm.pm_id 
                        left join tbl_production_schedule_details tpsd on tpm.schedule_d_id=tpsd.id 
                        left join tbl_delivery_orders tdo on tpsd.do_id=tdo.do_id 
                        left join tbl_sales_products tsp on tpsd.product_id=tsp.product_id
                        left join items i on tpmd.item_id=i.id
                        where tpm.branch_id=$branch_id and tpm.is_active=1 
                        and tpm.created_date between '" . $from_date . "' and '" . $too_date . "' order by tpm.pm_id desc";
            $data['casting']=$this->m_common->customeQuery($sql);

           
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $too_date = date('t-m-Y');
        }




        if ($print == false) {
            $this->load->view('sales_report/v_castingwise_consumption', $data);
        } else {
            $html = $this->load->view('sales_report/print_castingwise_consumption', $data, true);
            echo $html;
            exit;
        }
    }
    function salesAchivementDetails($print = false)
    {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Sales Achivement Details");
        $b_id = $this->input->post('branch_id');
        if (!empty($b_id)) {
            $branch_id = $b_id;
        } else {
            $branch_id = $this->session->userdata('companyId');
        }
        $data['employees'] = $this->m_common->get_row_array('employees', '', '*');
        $data['product_categories'] = $this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*');
        $where = '';
        $postData = $this->input->post();
        if (!empty($postData)) {
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $category_id = $this->input->post('category_id');
            $sale_person_id = $this->input->post('sale_person_id');
            $data['sale_person_id'] = $sale_person_id;
            $data['category_id'] = $category_id;


            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $to_date = date('t-m-Y');
            }
            if (!empty($sale_person_id)) {
                $where .= " and so.sale_person_id in(" . $sale_person_id . ")";
            }
            if (!empty($category_id)) {
                $where .= " and sp.category_id ='" . $category_id . "'";
            }
            $sql = "select dc.inv_id,dc.inv_no,dc.sale_invoice_date,dcd.mu_name,sum(dcd.quantity) as quantity,sum(dcd.amount) as amount,dcd.unit_price,do.delivery_no,so.order_no,sp.product_name,c.c_short_name 
                from tbl_sales_invoice_details dcd 
                            join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id
                join tbl_delivery_orders as do on dc.do_id=do.do_id
                join tbl_sales_orders as so on do.o_id=so.o_id
                join tbl_sales_products as sp on sp.product_id=dcd.s_item_id
                left join tbl_customers c on dc.customer_id=c.id
                where sp.measurement_unit!='SQ.M' and dc.status!='Canceled' and dcd.amount>0 and dc.sale_invoice_date between '" . $from_date . "' and '" . $too_date . "' $where group by dc.inv_id";
            $data['achievement'] = $this->m_common->customeQuery($sql);
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $too_date = date('t-m-Y');
        }




        if ($print == false) {
            $this->load->view('sales_report/v_achivement_details_report', $data);
        } else {
            $html = $this->load->view('sales_report/print_achivement_details_report', $data, true);
            echo $html;
            exit;
        }
    }
    function salesAchivementExcel()
    {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $b_id = $this->input->post('branch_id');
        if (!empty($b_id)) {
            $branch_id = $b_id;
        } else {
            $branch_id = $this->session->userdata('companyId');
        }
        $data['employees'] = $this->m_common->get_row_array('employees', '', '*');
        $data['product_categories'] = $this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');

        $data['branches'] = $this->m_common->get_row_array('department', '', '*');
        $where = '';

        $postData = $this->input->post();
        if (!empty($postData)) {
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $category_id = $this->input->post('category_id');
            $sale_person_id = $this->input->post('sale_person_id');
            $data['sale_person_id'] = $sale_person_id;
            $data['category_id'] = $category_id;


            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $to_date = date('t-m-Y');
            }
            if (!empty($sale_person_id)) {
                $where .= " and so.sale_person_id in(" . $sale_person_id . ")";
            }
            if (!empty($category_id)) {
                $where .= " and sp.category_id ='" . $category_id . "'";
            }
            $sql = "select dc.inv_id,dc.inv_no,dc.sale_invoice_date,dcd.mu_name,sum(dcd.quantity) as quantity,sum(dcd.amount) as amount,dcd.unit_price,do.delivery_no,so.order_no,sp.product_name,c.c_short_name 
                from tbl_sales_invoice_details dcd 
                            join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id
                join tbl_delivery_orders as do on dc.do_id=do.do_id
                join tbl_sales_orders as so on do.o_id=so.o_id
                join tbl_sales_products as sp on sp.product_id=dcd.s_item_id
                left join tbl_customers c on dc.customer_id=c.id
                where sp.measurement_unit!='SQ.M' and dc.status!='Canceled' and dcd.amount>0 and dc.sale_invoice_date between '" . $from_date . "' and '" . $too_date . "' $where group by dc.inv_id";
            $data['achievement'] = $this->m_common->customeQuery($sql);
        } else {
            $data['achievement'] = '';
        }


        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Sales Achievement Report');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:Q3')->applyFromArray($style);

        // $table_columns = array("SL", "Invoice Date", "Inv. No.", "So.No.",  "C.Name", "Project","Amount","Paid Amount","Due Amount");
        // $table_columns = array("SL", "Invoice Date", "Inv. No.", "So.No.",  "C.Name", "Project","Product Name",'M.U.',"Quantity","Rate","Amount","Paid Amount","Due Amount"); //2021-02-14
        $table_columns = array("SL", "SO No", "Inv No",  "Date", "Customer", "Product", 'M.U.', "Quantity", "Rate", "Amount");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setBold(true);


        $excel_row = 6;
        if (!empty($data['achievement'])) {
            $total = 0;
            $achive_total = 0;
            $qty_total = 0;
            $dtotal = 0;
            $i = 0;
            foreach ($data['achievement'] as $invoice) {
                if ($invoice['amount'] == 0)
                    continue;
                $i++;
                $total += $invoice['amount'];
                $qty_total += $invoice['quantity'];

                $object->getActiveSheet()->setCellValueByColumnAndRow(5, $excel_row, $i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6, $excel_row, $invoice['order_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(7, $excel_row, $invoice['inv_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8, $excel_row, date('d-m-Y', strtotime($invoice['sale_invoice_date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(9, $excel_row, $invoice['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10, $excel_row, $invoice['product_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, $invoice['mu_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, number_format($invoice['quantity'], 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, number_format($invoice['unit_price'], 2));
                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, number_format($invoice['amount'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(11, $excel_row, 'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, round($qty_total, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, '');
        $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, round($total, 2));

        $object->getActiveSheet()->getStyle("L$excel_row:Q$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("L$excel_row:Q$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:T' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('M6:R' . $excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col = 'F'; $col !== 'Q'; $col++) {
            $object->getActiveSheet()
                ->getColumnDimension($col)
                ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="salesAchievementReport.xls"');
        $object_writer->save('php://output');
    }
    function salesAchivementSummary($print = false)
    {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Sales Achivement Summary");
        $b_id = $this->input->post('branch_id');
        if (!empty($b_id)) {
            $branch_id = $b_id;
        } else {
            $branch_id = $this->session->userdata('companyId');
        }
        $data['employees'] = $this->m_common->get_row_array('employees', '', '*');
        $data['product_categories'] = $this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*');
        $where = '';
        $f_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        $category_id = $this->input->post('category_id');
        $sale_person_id = $this->input->post('sale_person_id');
        $data['sale_person_id'] = $sale_person_id;
        $data['category_id'] = $category_id;

        if (!empty($f_date) & !empty($to_date)) {
            $from_date = date('Y-m-d', strtotime($f_date));
            $too_date = date('Y-m-d', strtotime($to_date));
            $data['f_date'] = $f_date;
            $data['to_date'] = $to_date;
        } else if (!empty($f_date)) {
            $from_date = date('Y-m-d', strtotime($f_date));
            $data['f_date'] = $f_date;
            $data['to_date'] = '';
        } else if (!empty($to_date)) {
            $too_date = date('Y-m-d', strtotime($to_date));
            $data['f_date'] = '';
            $data['to_date'] = $to_date;
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $to_date = date('t-m-Y');
        }
        if (!empty($sale_person_id)) {
            $where .= " and so.sale_person_id in(" . $sale_person_id . ")";
        }
        if (!empty($category_id)) {
            $where .= " and sp.category_id ='" . $category_id . "'";
        }
        $sql = "select sum(dcd.quantity) as quantity,sum(dcd.amount) as amount,sum(dcd.received_amount) as paid,e.name,pc.category_name,e.id
            from tbl_sales_invoice_details dcd 
                        join tbl_sales_invoices dc on dcd.inv_id=dc.inv_id
            join tbl_delivery_orders as do on dc.do_id=do.do_id
            join tbl_sales_orders as so on do.o_id=so.o_id
            join tbl_sales_products as sp on sp.product_id=dcd.s_item_id
            left join employees e on so.sale_person_id=e.id
            left join tbl_product_categories pc on sp.category_id=pc.category_id
                where sp.measurement_unit!='SQ.M' and dc.status!='Canceled' and dcd.amount>0 and dc.sale_invoice_date between '" . $from_date . "' and '" . $too_date . "' group by so.sale_person_id,sp.category_id";
        $dt = $this->m_common->customeQuery($sql);
        $array = array();
        foreach ($dt as $row) {
            $array[$row['id']]['name'] = $row['name'];
            $array[$row['id']][$row['category_name']] = $row;
        }
        $data['achievement'] = $array;





        if ($print == false) {
            $this->load->view('sales_report/v_achivement_summary_report', $data);
        } else {
            $html = $this->load->view('sales_report/print_achivement_summary_report', $data, true);
            echo $html;
            exit;
        }
    }


    function daily_statement($print = false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        $where = "1=1";
        $postData = $this->input->post();

            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $category_id = $this->input->post('category_id');
            $bill_status=$this->input->post('bill_status');



            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                    $where .= "so.customer_id=$customer_id";
                } else {
                    $where .= " and so.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }



            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                    $where .= "so.project_id=$project_id";
                } else {
                    $where .= " and so.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "do.o_id=$order_id";
                } else {
                    $where .= " and do.o_id=$order_id";
                }
            }

            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "p.category_id=$category_id";
                } else {
                    $where .= " and p.category_id=$category_id";
                }
            }
            
            if (!empty($product_id)) {
                $data['product_id'] = $product_id;
                if (empty($where)) {
                    $where .= "p.product_id=$product_id";
                } else {
                    $where .= " and p.product_id=$product_id";
                }
            }

            if (!empty($bill_status)) {
                $data['bill_status'] = $bill_status;
                if (empty($where)) {
                    $where .= "dcd.bill_status='$bill_status'";
                } else {
                    $where .= " and dcd.bill_status='$bill_status'";
                }
            }else{
                $data['bill_status'] ='';
            }
            
            
            if (!empty($f_date) & !empty($to_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-d');
                $data['to_date'] = $too_date = date('Y-m-d');
                $f_date = date('d-m-Y');
                $to_date = date('d-m-Y');
            }


            if (!empty($f_date) & !empty($to_date)) {
                $sql1 = "select pc.*,c.c_name,c_short_name,tpc.category_name,(select realization_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_date,(select deposit_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)deposit_date,(select realization_status from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_status from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $from_date . "' and pc.receive_date<='" . $too_date . "' group by pc.id order by pc.receive_date desc,dr.realization_date"; 
                $sql = "select d.*,dod.unit_price,do.delivery_no,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_production_statement_details d left join tbl_production_statement as ps on ps.pst_id=d.pst_id left join tbl_delivery_orders as do on d.do_id=do.do_id left join tbl_production_schedule_details as psd on psd.id=d.psd_id left join tbl_delivery_order_details as dod on psd.do_details_id=dod.do_details_id left join tbl_sales_products sp on d.product_id=sp.product_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id where $where and d.is_active=1 and ps.date>='" . $from_date . "' and ps.date<='" . $too_date . "'";
            } else if (!empty($f_date)) {
                $sql1 = "select pc.*,c.c_name,c_short_name,tpc.category_name,(select realization_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_date,(select deposit_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)deposit_date,(select realization_status from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_status from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date>='" . $from_date . "' group by pc.id order by pc.receive_date desc,dr.realization_date"; 
                $sql = "select d.*,dod.unit_price,do.delivery_no,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_production_statement_details d left join tbl_production_statement as ps on ps.pst_id=d.pst_id left join tbl_delivery_orders as do on d.do_id=do.do_id left join tbl_production_schedule_details as psd on psd.id=d.psd_id left join tbl_delivery_order_details as dod on psd.do_details_id=dod.do_details_id left join tbl_sales_products sp on d.product_id=sp.product_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id where $where and d.is_active=1 and ps.date>='" . $from_date . "'";
            } else if (!empty($to_date)) {
                $sql1 = "select pc.*,c.c_name,c_short_name,tpc.category_name,(select realization_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_date,(select deposit_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)deposit_date,(select realization_status from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_status from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where and pc.receive_date<='" . $too_date . "' group by pc.id order by pc.receive_date desc,dr.realization_date"; 
                $sql = "select d.*,dod.unit_price,do.delivery_no,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_production_statement_details d left join tbl_production_statement as ps on ps.pst_id=d.pst_id left join tbl_delivery_orders as do on d.do_id=do.do_id left join tbl_production_schedule_details as psd on psd.id=d.psd_id left join tbl_delivery_order_details as dod on psd.do_details_id=dod.do_details_id left join tbl_sales_products sp on d.product_id=sp.product_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id where $where and d.is_active=1 and ps.date<='" . $too_date . "'";
            } else {
                $sql1 = "select pc.*,c.c_name,c_short_name,tpc.category_name,(select realization_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_date,(select deposit_date from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)deposit_date,(select realization_status from tbl_deposit_realization  where collection_id=pc.id order by id desc  limit 1)realization_status from tbl_payment_collections pc left join tbl_customers c on pc.customer_id=c.id left join tbl_deposit_realization dr on pc.id=dr.collection_id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where $where group by pc.id order by pc.receive_date desc,dr.realization_date"; 
                $sql = "select d.*,dod.unit_price,do.delivery_no,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_production_statement_details d left join tbl_production_statement as ps on ps.pst_id=d.pst_id left join tbl_delivery_orders as do on d.do_id=do.do_id left join tbl_production_schedule_details as psd on psd.id=d.psd_id left join tbl_delivery_order_details as dod on psd.do_details_id=dod.do_details_id left join tbl_sales_products sp on d.product_id=sp.product_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id where $where and d.is_active=1";
            }
            $data['productions'] = $this->m_common->customeQuery($sql);
            $data['collections'] = $this->m_common->customeQuery($sql1);
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
       

        
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*');
        
        if ($print == false) {
            $this->load->view('sales_report/daily_statement', $data);
        } else {
            $html = $this->load->view('sales_report/daily_statement_print', $data, true);
            echo $html;
            exit;
        }
    }
    function deposit_statement($print = false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        $where = "1=1";
        $postData = $this->input->post();

           if(!empty($postData)){
            $sql = "select dr.*,pc.check_date,pc.bg_issue_date,pc.po_date,pc.lc_date,pc.mrr_no,pc.remark as c_remark,pc.collection_method,pc.collection_method,pc.amount,pc.no,b.b_name,b.b_short_name,b.branch_name,tc.c_name,c_short_name,tpc.category_name from tbl_deposit_realization dr left join tbl_payment_collections pc on dr.collection_id=pc.id left join tbl_banks b on dr.bank_id=b.id left join tbl_sales_orders tso on pc.o_id=tso.o_id left join tbl_customers tc on pc.customer_id=tc.id left join tbl_product_categories tpc on pc.payment_for_id=tpc.category_id where dr.bank_id='".$postData['bank_id']."' and dr.realization_status='Deposited' order by dr.deposit_date DESC";
            $data['deposits'] = $this->m_common->customeQuery($sql);
            $data['bank_id'] = $postData['bank_id'];
            $data['bank_info'] = $this->m_common->get_row_array('tbl_banks', array('is_active' =>1,'id'=>$postData['bank_id']), '*');
           }else{
               $data['deposits'] = array();
               $data['bank_id'] = '';
           }
           
                
            
            $data['banks'] = $this->m_common->get_row_array('tbl_banks', array('is_active' =>1), '*');
            
       
        
        if ($print == false) {
            $this->load->view('sales_report/deposit_statement', $data);
        } else {
            $html = $this->load->view('sales_report/deposit_statement_print', $data, true);
            echo $html;
            exit;
        }
    }
    function accounts_receivable($print=false){
        $this->menu='sales';
        $this->sub_inner_menu='sales_report';
        $this->titlebackend("Report");


        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
    //    $where = "inv.unit_id=$branch_id";
        
        $f_date=$this->input->post('from_date');
        $to_date=$this->input->post('to_date');
        $customer_id=$this->input->post('customer_id');
        $category_id=$this->input->post('category_id');
        
        $where="inv.is_active=1";
        if(!empty($f_date) && !empty($to_date)){
            $f_date = date('Y-m-d',strtotime($f_date));
            $to_date = date('Y-m-d',strtotime($to_date));
            $data['f_date']=$f_date;
            $data['to_date']=$to_date;
            //$where .= " and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date')";
        }else if(!empty($f_date)){                
            $data['f_date']=$f_date;
        }else if(!empty($to_date)){                       
            $data['f_date']=$to_date;
        }else{
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('01-m-Y');
            $to_date = date('t-m-Y');
        }

        
        if(!empty($customer_id)){
            $data['customer_id']=$customer_id;
            $where .= " and inv.customer_id=$customer_id";
        } else {
            $data['customer_id']='';
        }
        
        $postData = $this->input->post();
       
        $data['categories'] = $this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*', '', '', 'category_name');
           
        
        foreach($data['categories'] as $key=>$value){
            $opening_r_sales=array();
            $opening_sales=array();
            
            $sales=array();
            $collections=array();
            
        //    $sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.is_active=1 and (inv.status='Pending' or inv.status='Partial Received') and so.customer_id=".$value['id']." order by inv.sale_invoice_date";   
            
            if(!empty($f_date) && !empty($to_date)){
                $o_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and inv.sale_invoice_date<'$f_date' and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; 
                $ope_re_sql="select sum(invd.quantity) as total_qty,sum(invd.received_amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and inv.sale_invoice_date<'$f_date' and inv.category_id=".$value['category_id']." and invd.amount>0 and (invd.received_status='Received' or invd.received_status='Partial Received') and inv.status!='Canceled' order by inv.sale_invoice_date";
                $opening_r_sales=$this->m_common->customeQuery($ope_re_sql);
            }else{
                $o_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; 
                $opening_r_sales='';
            } 
            
            $opening_sales=$this->m_common->customeQuery($o_sql);
            
            if(!empty($opening_r_sales)){
                $op_qty=$opening_sales[0]['total_qty']-$opening_r_sales[0]['total_qty'];
                $op_amount=$opening_sales[0]['total_amount']-$opening_r_sales[0]['total_amount'];
            }else{
                if(!empty($f_date) && !empty($to_date)){
                    $op_qty=$opening_sales[0]['total_qty'];
                    $op_amount=$opening_sales[0]['total_amount'];
                }else{
                    $op_qty=0;
                    $op_amount=0;
                }
            }
                    
            $data['categories'][$key]['opening_qty']=$op_qty;
            $data['categories'][$key]['opening_amount']=$op_amount;    
            
            if(!empty($f_date) && !empty($to_date)){
                $s_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date') and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; 
                
            }else{
                $s_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where  and inv.category_id=".$value['category_id']." and invd.amount>0 and inv.status!='Canceled' order by inv.sale_invoice_date"; 
            }    
            $sales= $this->m_common->customeQuery($s_sql);
            $data['categories'][$key]['sale_qty']=$sales[0]['total_qty'];
            $data['categories'][$key]['sale_amount']=$sales[0]['total_amount'];   
            
            $data['categories'][$key]['receivable_qty']=$op_qty+$sales[0]['total_qty'];
            $data['categories'][$key]['receivable_amount']=$op_amount+$sales[0]['total_amount']; 
            
            if(!empty($f_date) && !empty($to_date)){
                $c_sql="select sum(invd.quantity) as total_qty,sum(invd.received_amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date') and inv.category_id=".$value['category_id']." and invd.amount>0 and (invd.received_status='Received' or invd.received_status='Partial Received') and inv.status!='Canceled' order by inv.sale_invoice_date"; 
            }else{
                $c_sql="select sum(invd.quantity) as total_qty,sum(invd.received_amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where $where and inv.category_id=".$value['category_id']." and invd.amount>0 and (invd.received_status='Received' or invd.received_status='Partial Received') and inv.status!='Canceled' order by inv.sale_invoice_date"; 
            }    
            $collections= $this->m_common->customeQuery($c_sql);
            $data['categories'][$key]['collection_qty']=$collections[0]['total_qty'];
            $data['categories'][$key]['collection_amount']=$collections[0]['total_amount'];
            
            $data['categories'][$key]['closing_qty']=$op_qty+$sales[0]['total_qty']-$collections[0]['total_qty'];
            $data['categories'][$key]['closing_amount']=$op_amount+$sales[0]['total_amount']-$collections[0]['total_amount'];
            
        }
        $data['customers_info'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        //$data['product_categories']=$this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*'); 
        if($print == false){
            $this->load->view('sales_report/accounts_receivable',$data);
        }else{
            $html = $this->load->view('sales_report/accounts_receivable_print',$data,true);
            echo $html;
            exit;
        }
    }
    function accounts_receivable_customer($f_date,$to_date,$category_id,$print=false){
        $this->menu='sales';
        $this->sub_inner_menu='sales_report';
        $this->titlebackend("Report");


        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
        
        $where="inv.is_active=1";
        if(!empty($f_date) && !empty($to_date)){
            $f_date = date('Y-m-d',strtotime($f_date));
            $to_date = date('Y-m-d',strtotime($to_date));
            $data['f_date']=$f_date;
            $data['to_date']=$to_date;
            //$where .= " and (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date')";
        }else if(!empty($f_date)){                
            $data['f_date']=$f_date;
        }else if(!empty($to_date)){                       
            $data['f_date']=$to_date;
        }else{
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('01-m-Y');
            $to_date = date('t-m-Y');
        }

        
        if(!empty($customer_id)){
            $data['customer_id']=$customer_id;
            $where .= " and inv.customer_id=$customer_id";
        } else {
            $data['customer_id']='';
        }
        
        $postData = $this->input->post();
       
        $data['cat_info'] = $this->m_common->get_row_array('tbl_product_categories', array('category_id' => $category_id), '*', '', '', 'category_name');
           
        
            $opening_r_sales=array();
            $opening_sales=array();
            
            $sales=array();
            $collections=array();
            
        //    $sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_delivery_orders do on inv.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_customers c on so.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.is_active=1 and (inv.status='Pending' or inv.status='Partial Received') and so.customer_id=".$value['id']." order by inv.sale_invoice_date";   
            
                $o_sql="select sum(invd.quantity) as total_qty,inv.customer_id,c.c_name,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.sale_invoice_date<'$f_date' and inv.category_id=".$category_id." and invd.amount>0 and inv.status!='Canceled' group by inv.customer_id order by c.c_name"; 
                $opening_sales=$this->m_common->customeQuery($o_sql);
foreach($opening_sales as $key=>$opening){
    $ope_re_sql="select sum(invd.quantity) as total_qty,sum(invd.received_amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where inv.sale_invoice_date<'$f_date' and inv.category_id=".$category_id." and inv.customer_id=".$opening['customer_id']." and invd.amount>0 and (invd.received_status='Received' or invd.received_status='Partial Received') and inv.status!='Canceled' group by inv.customer_id order by inv.sale_invoice_date";
    $opening_r_sales=$this->m_common->customeQuery($ope_re_sql);
        if(!empty($opening_r_sales)){
            $op_amount=$opening['total_amount']-$opening_r_sales[0]['total_amount'];
        }else{
            if(!empty($f_date) && !empty($to_date)){
                $op_amount=$opening['total_amount'];
            }else{
                $op_amount=0;
            }
        } 
        $opening_sales[$key]['opening_amount']=$op_amount;

        $s_sql="select sum(invd.quantity) as total_qty,sum(invd.amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date') and inv.category_id=".$category_id." and inv.customer_id=".$opening['customer_id']." and invd.amount>0 and inv.status!='Canceled' group by inv.customer_id order by inv.sale_invoice_date"; 
            
        $sales= $this->m_common->customeQuery($s_sql);
        $opening_sales[$key]['sale_amount']=$sales[0]['total_amount'];   

        $c_sql="select sum(invd.quantity) as total_qty,sum(invd.received_amount) as total_amount from tbl_sales_invoices inv left join tbl_sales_invoice_details invd on inv.inv_id=invd.inv_id left join tbl_customers c on inv.customer_id=c.id left join tbl_product_categories tpc on inv.category_id=tpc.category_id  where (inv.sale_invoice_date>='$f_date' and inv.sale_invoice_date<='$to_date') and inv.category_id=".$category_id." and inv.customer_id=".$opening['customer_id']." and invd.amount>0 and (invd.received_status='Received' or invd.received_status='Partial Received') and inv.status!='Canceled' group by inv.customer_id order by inv.sale_invoice_date"; 
             
        $collections= $this->m_common->customeQuery($c_sql);
        $opening_sales[$key]['collection_amount']=$collections[0]['total_amount'];
        
        $opening_sales[$key]['closing_amount']=$op_amount+$sales[0]['total_amount']-$collections[0]['total_amount'];
}

     $data['categories'] = $opening_sales;
     $data['category_id'] = $category_id;
            
        
        if($print == false){
            $this->load->view('sales_report/accounts_receivable_customer',$data);
        }else{
            $html = $this->load->view('sales_report/accounts_receivable_customer_print',$data,true);
            echo $html;
            exit;
        }
    }
    
    
    
    function cancelInvoice($print = false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $b_id = $this->input->post('branch_id');
        if(!empty($b_id)){
            $branch_id =$b_id; 
        }else{
            $branch_id=$this->session->userdata('companyId');
        }
        $data['employees'] = $this->m_common->get_row_array('employees','', '*');
        $data['product_categories']=$this->m_common->get_row_array('tbl_product_categories', array('is_active' => 1), '*'); 
        $data['branch_info'] = $this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
        
        $data['branches'] = $this->m_common->get_row_array('department','','*');
        $where = '';
        
       // $where .="tsi.unit_id=".$branch_id;
        $where .= "tsi.is_active=1 and tsi.status='Canceled'";
        $postData = $this->input->post();
        if (!empty($postData)) {
            $b_id = $this->input->post('branch_id');
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $category_id = $this->input->post('category_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $bill_status=$this->input->post('bill_status');
            $s_p_id=$this->input->post('sale_person_id');
            
            if (!empty($b_id)){
                $data['branch_id']=$b_id;
                if (empty($where)) {
                   // $where .= "so.customer_id=$customer_id";
                    $where .= "tsi.unit_id=$b_id";
                } else {
                    //$where .= " and so.customer_id=$customer_id";
                    $where .= " and tsi.unit_id=$b_id";
                }
                
            } else {
                $data['branch_id'] = '';
            }
            
            

            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                   // $where .= "so.customer_id=$customer_id";
                    $where .= "tsi.customer_id=$customer_id";
                } else {
                    //$where .= " and so.customer_id=$customer_id";
                    $where .= " and tsi.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }

            
            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "tsi.category_id=$category_id";
                } else {
                    $where .= " and tsi.category_id=$category_id";
                }
            } else {
                $data['category_id'] = '';
            }

            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                   // $where .= "so.project_id=$project_id";
                    $where .= "tsi.project_id=$project_id";
                } else {
                    $where .= " and tsi.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "so.o_id=$order_id";
                } else {
                    $where .= " and so.o_id=$order_id";
                }
            }

           
            if (!empty($s_p_id)) {
                $data['sale_person_id'] = $s_p_id;
                if (empty($where)) {
                    $where .= "so.sale_person_id=$s_p_id";
                } else {
                    $where .= " and so.sale_person_id=$s_p_id";
                }
            } else {
                $data['sale_person_id'] = '';
            }
            
            
            if(!empty($f_date) & !empty($to_date)){
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $too_date = date('t-m-Y');
            }


            if(!empty($f_date) & !empty($to_date)){
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.is_active=1 and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
            }else if (!empty($f_date)){                
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC";
            }else if (!empty($to_date)){
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
            }else{
              //  $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
              //  $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1";
            }
            $data['invoices'] = $this->m_common->customeQuery($sql);
            
            foreach($data['invoices'] as $key=>$value){
              //  $s_d="select sum(quantity) as total_amount,unit_price,mu_name from tbl_sales_invoice_details where amount>0 and inv_id=".$value['inv_id'];
                $s_d="select sum(quantity) as total_amount,unit_price,mu_name,tsp.product_name from tbl_sales_invoice_details tsid left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id  where amount>0 and inv_id=".$value['inv_id'];
                $t_amount=$this->m_common->customeQuery($s_d);
                $data['invoices'][$key]['total_qty']=$t_amount[0]['total_amount'];
                $data['invoices'][$key]['unit_price']=$t_amount[0]['unit_price'];
                $data['invoices'][$key]['mu_name']=$t_amount[0]['mu_name'];
                $data['invoices'][$key]['product_name']=$t_amount[0]['product_name'];
            
            }
            
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $too_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            if(!empty($f_date) & !empty($to_date)){
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.is_active=1 and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
            }else if (!empty($f_date)){                
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC";
            }else if (!empty($to_date)){
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
            }else{
              //  $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
              //  $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1"; //2021-02-14
                  $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1";
            }
            
            $data['invoices'] = $this->m_common->customeQuery($sql);
            
            foreach($data['invoices'] as $key=>$value){
                $s_d="select sum(quantity) as total_amount,unit_price,mu_name,tsp.product_name from tbl_sales_invoice_details tsid left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id  where amount>0 and inv_id=".$value['inv_id'];
                $t_amount=$this->m_common->customeQuery($s_d);
                $data['invoices'][$key]['total_qty']=$t_amount[0]['total_amount'];
                $data['invoices'][$key]['unit_price']=$t_amount[0]['unit_price'];
                $data['invoices'][$key]['mu_name']=$t_amount[0]['mu_name'];
                $data['invoices'][$key]['product_name']=$t_amount[0]['product_name'];
            
            }
        }
        
        
        

        if($print==false){
            $this->load->view('sales_report/v_cancel_invoice_report', $data);
        } else {
            $html = $this->load->view('sales_report/print_cancel_invoice', $data, true);
            echo $html;
            exit;
        }
    }
    
    
    function cancelInvoiceExcel($print = false) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'sales_report';
        $this->titlebackend("Report");
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
       // $where = "so.unit_id=$branch_id";
        
      //  $where .="tsi.unit_id=".$branch_id;
        $where .= "tsi.is_active=1 and tsi.status='Canceled'";
        $postData = $this->input->post();
         if (!empty($postData)) {
            $b_id = $this->input->post('branch_id');
            $f_date = $this->input->post('from_date');
            $to_date = $this->input->post('to_date');
            $customer_id = $this->input->post('customer_id');
            $project_id = $this->input->post('project_id');
            $category_id = $this->input->post('category_id');
            $order_id = $this->input->post('o_id');
            $product_id = $this->input->post('product_id');
            $bill_status=$this->input->post('bill_status');
            $s_p_id=$this->input->post('sale_person_id');
            
            if (!empty($b_id)){
                $data['branch_id']=$b_id;
                if (empty($where)) {
                   // $where .= "so.customer_id=$customer_id";
                    $where .= "tsi.unit_id=$b_id";
                } else {
                    //$where .= " and so.customer_id=$customer_id";
                    $where .= " and tsi.unit_id=$b_id";
                }
                
            } else {
                $data['branch_id'] = '';
            }
            
            

            if (!empty($customer_id)) {
                $data['customer_id'] = $customer_id;
                if (empty($where)) {
                   // $where .= "so.customer_id=$customer_id";
                    $where .= "tsi.customer_id=$customer_id";
                } else {
                    //$where .= " and so.customer_id=$customer_id";
                    $where .= " and tsi.customer_id=$customer_id";
                }
                $data['projects'] = $this->m_common->get_row_array('tbl_project', array('is_active' => 1, 'customer_id' => $customer_id), '*');
            } else {
                $data['projects'] = '';
            }

            
            if (!empty($category_id)) {
                $data['category_id'] = $category_id;
                if (empty($where)) {
                    $where .= "tsi.category_id=$category_id";
                } else {
                    $where .= " and tsi.category_id=$category_id";
                }
            } else {
                $data['category_id'] = '';
            }

            if (!empty($project_id)) {
                $data['project_id'] = $project_id;
                if (empty($where)) {
                   // $where .= "so.project_id=$project_id";
                    $where .= "tsi.project_id=$project_id";
                } else {
                    $where .= " and tsi.project_id=$project_id";
                }
            } else {
                $data['project_id'] = '';
            }



            if (!empty($order_id)) {
                $data['order_id'] = $order_id;
                if (empty($where)) {
                    $where .= "so.o_id=$order_id";
                } else {
                    $where .= " and so.o_id=$order_id";
                }
            }

           
            if (!empty($s_p_id)) {
                $data['sale_person_id'] = $s_p_id;
                if (empty($where)) {
                    $where .= "so.sale_person_id=$s_p_id";
                } else {
                    $where .= " and so.sale_person_id=$s_p_id";
                }
            } else {
                $data['sale_person_id'] = '';
            }
            
            
            if(!empty($f_date) & !empty($to_date)){
                $from_date = date('Y-m-d', strtotime($f_date));
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = $to_date;
            } else if (!empty($f_date)) {
                $from_date = date('Y-m-d', strtotime($f_date));
                $data['f_date'] = $f_date;
                $data['to_date'] = '';
            } else if (!empty($to_date)) {
                $too_date = date('Y-m-d', strtotime($to_date));
                $data['f_date'] = '';
                $data['to_date'] = $to_date;
            } else {
                $data['f_date'] = $from_date = date('Y-m-01');
                $data['to_date'] = $too_date = date('Y-m-t');
                $f_date = date('d-m-Y');
                $too_date = date('t-m-Y');
            }


            if(!empty($f_date) & !empty($to_date)){
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.is_active=1 and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
            }else if (!empty($f_date)){                
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC";
            }else if (!empty($to_date)){
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
            }else{
              //  $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
              //  $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1";
            }
            $data['invoices'] = $this->m_common->customeQuery($sql);
            
            foreach($data['invoices'] as $key=>$value){
              //  $s_d="select sum(quantity) as total_amount,unit_price,mu_name from tbl_sales_invoice_details where amount>0 and inv_id=".$value['inv_id'];
                $s_d="select sum(quantity) as total_amount,unit_price,mu_name,tsp.product_name from tbl_sales_invoice_details tsid left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id  where amount>0 and inv_id=".$value['inv_id'];
                $t_amount=$this->m_common->customeQuery($s_d);
                $data['invoices'][$key]['total_qty']=$t_amount[0]['total_amount'];
                $data['invoices'][$key]['unit_price']=$t_amount[0]['unit_price'];
                $data['invoices'][$key]['mu_name']=$t_amount[0]['mu_name'];
                $data['invoices'][$key]['product_name']=$t_amount[0]['product_name'];
            
            }
            
            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
        } else {
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $f_date = date('d-m-Y');
            $too_date = date('t-m-Y');
            $data['order_id'] = '';
            $data['customer_id'] = '';
            $data['product_id'] = '';

            $data['all_orders'] = $this->m_common->get_row_array('tbl_sales_orders', array('is_active' => 1), '*');
            //$data['delivery_orders']=$this->m_common->get_row_array('tbl_delivery_orders',array('is_active'=>1),'*');
            $data['products'] = $this->m_common->get_row_array('tbl_sales_products', array('is_active' => 1), '*');
            //  $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
            $data['customers'] = $this->m_common->get_row_array('tbl_customers', array('is_active' => 1), '*', '', '', 'c_name');
            if(!empty($f_date) & !empty($to_date)){
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.is_active=1 and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on tsi.project_id=tp.project_id left join tbl_customers tc on tsi.customer_id=tc.id where $where and tsi.sale_invoice_date>='" . $from_date . "' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
            }else if (!empty($f_date)){                
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.sale_invoice_date>='" . $from_date . "' order by tsi.sale_invoice_date ASC";
            }else if (!empty($to_date)){
               // $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.status!='Canceled' and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC"; //2021-02-14
                $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id where $where and tsi.sale_invoice_date<='" . $too_date . "' order by tsi.sale_invoice_date ASC";
            }else{
              //  $sql = "select dcd.*,dc.dc_no,dc.delivery_challan_date,so.project_name,do.delivery_no,do.delivery_order_date,so.order_no,so.sale_order_date,c.c_name,p.product_name,p.measurement_unit,dr.driver_name,tk.truck_no from tbl_delivery_challan_details dcd left join tbl_delivery_challans dc on dcd.dc_id=dc.dc_id left join tbl_delivery_orders do on  dc.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on so.customer_id=c.id left join tbl_sales_products p on dcd.s_item_id=p.product_id left join tbl_driver dr on dc.driver_id=dr.driver_id left join tbl_truck tk on dc.truck_id=tk.truck_id where $where and dc.is_active=1 order by dc.dc_id desc ";
              //  $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1"; //2021-02-14
                  $sql="select tsi.*,tp.project_name,tc.c_name,so.order_no,e.name from  tbl_sales_invoices as tsi left join tbl_delivery_orders do on  tsi.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join employees e on so.sale_person_id=e.id left join tbl_project tp on so.project_id=tp.project_id left join tbl_customers tc on so.customer_id=tc.id from tbl_sales_invoices where is_active=1";
            }
            
            $data['invoices'] = $this->m_common->customeQuery($sql);
            
            foreach($data['invoices'] as $key=>$value){
                $s_d="select sum(quantity) as total_amount,unit_price,mu_name,tsp.product_name from tbl_sales_invoice_details tsid left join tbl_sales_products tsp on tsid.s_item_id=tsp.product_id  where amount>0 and inv_id=".$value['inv_id'];
                $t_amount=$this->m_common->customeQuery($s_d);
                $data['invoices'][$key]['total_qty']=$t_amount[0]['total_amount'];
                $data['invoices'][$key]['unit_price']=$t_amount[0]['unit_price'];
                $data['invoices'][$key]['mu_name']=$t_amount[0]['mu_name'];
                $data['invoices'][$key]['product_name']=$t_amount[0]['product_name'];
            
            }
        }


        $object = new PHPExcel();

        $object->setActiveSheetIndex(0);
        $object->getActiveSheet()->getStyle('I1')->getFont()->setSize('18');
        $object->getActiveSheet()->getStyle('I1')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 1, 'Karim Asphalt & Ready Mix Ltd.');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I2')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 2, $data['branch_info'][0]['dep_description']);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setSize('13');
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(true);
        $object->getActiveSheet()->setCellValueByColumnAndRow(8, 3, 'Invoice Summary Report');
        $style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            )
        );
        $object->getActiveSheet()->getStyle('I1:Q3')->applyFromArray($style);

       // $table_columns = array("SL", "Invoice Date", "Inv. No.", "So.No.",  "C.Name", "Project","Amount","Paid Amount","Due Amount");
       // $table_columns = array("SL", "Invoice Date", "Inv. No.", "So.No.",  "C.Name", "Project","Product Name",'M.U.',"Quantity","Rate","Amount","Paid Amount","Due Amount"); //2021-02-14
        $table_columns = array("SL", "Invoice Date", "Inv. No.", "So.No.",  "C.Name", "Project","Product Name",'M.U.',"Quantity","Rate","Amount","Paid Amount","Due Amount","Sales Person");

        $column = 5;

        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 5, $field);
            $column++;
        }
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle('F5:N5')->getFont()->setBold(true);


        $excel_row = 6;
        if (!empty($data['invoices'])){
            $total_qty=0;
            $total=0;
            $total_received=0;
            $total_due=0;
            $i = 0;
            foreach ($data['invoices'] as $invoice) {
                $due=0;
                $total_qty=$total_qty+$invoice['total_qty'];
                $total=$total+$invoice['total_amount'];
                $total_received=$total_received+$invoice['received_amount'];
                $i++;
                                            
                $due=$invoice['total_amount']-$invoice['received_amount'];
                $total_due=$total_due+$due;
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(5,$excel_row,$i);
                $object->getActiveSheet()->setCellValueByColumnAndRow(6,$excel_row,date('d-m-Y', strtotime($invoice['sale_invoice_date'])));
                $object->getActiveSheet()->setCellValueByColumnAndRow(7,$excel_row,$invoice['inv_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(8,$excel_row,$invoice['order_no']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(9,$excel_row,$invoice['c_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(10,$excel_row,$invoice['project_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(11,$excel_row,$invoice['product_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(12,$excel_row,$invoice['mu_name']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(13,$excel_row,$invoice['total_qty']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(14,$excel_row,$invoice['unit_price']);
                $object->getActiveSheet()->setCellValueByColumnAndRow(15,$excel_row,round($invoice['total_amount'], 2));
                if(!empty($invoice['received_amount'])){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row,round($invoice['received_amount'], 2));
                }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row,'');
                }
                if(!empty($due)){
                    $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row, round($due, 2));
                }else{
                    $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row,'');
                }
                
                $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row,$invoice['name']);
//                $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row, number_format($invoice['quantity'], 2));
//                $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row, number_format($invoice['truck_no'], 2));
//                $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row, number_format($invoice['driver_name'], 2));

                $excel_row++;
            }
        }
        $object->getActiveSheet()->setCellValueByColumnAndRow(12, $excel_row, 'Total');
        $object->getActiveSheet()->setCellValueByColumnAndRow(13, $excel_row, round($total_qty, 2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(14, $excel_row,'');
        $object->getActiveSheet()->setCellValueByColumnAndRow(15, $excel_row,round($total,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(16, $excel_row,round($total_received,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(17, $excel_row,round($total_due,2));
        $object->getActiveSheet()->setCellValueByColumnAndRow(18, $excel_row,'');

        $object->getActiveSheet()->getStyle("L$excel_row:Q$excel_row")->getFont()->setSize('12');
        $object->getActiveSheet()->getStyle("L$excel_row:Q$excel_row")->getFont()->setBold(true);

        $styleArray = array(
            'borders' => array(
                'allborders' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THIN
                )
            )
        );

        $object->getActiveSheet()->getStyle('F5:S' . $excel_row)->applyFromArray($styleArray);
        $object->getActiveSheet()->getStyle('M6:R'.$excel_row)->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // Auto size columns for each worksheet
        for ($col='F';$col !=='Q';$col++){
            $object->getActiveSheet()
                    ->getColumnDimension($col)
                    ->setAutoSize(true);
        }

        $object_writer = PHPExcel_IOFactory::createWriter($object, 'Excel5');
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="invoiceSummaryReport.xls"');
        $object_writer->save('php://output');
    }
    
    

}
