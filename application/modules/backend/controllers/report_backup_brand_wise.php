<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends Site_Controller {

    function __construct() {
        parent::__construct();
        ini_set('max_execution_time', 90000);
        set_time_limit(90000);
        ini_set('memory_limit', '-1');
        ini_set('post_max_size', '2048M');
        ini_set('max_input_time', '90000');
        if(!$this->is_logged_in($this->session->userdata('logged_in'))){
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
        $this->menu = 'report';
        $this->sub_menu = 'report';
        $this->titlebackend("Report");

        $this->load->view('report/report_list');
    }
    
    function materialStock($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $postData = $this->input->post();
        $branch_id= $this->session->userdata('companyId'); 
        $brands= $this->m_common->get_row_array('tbl_item_brand',array('is_active'=>1), '*');
        if(!empty($postData)){
               $report_format=$this->input->post('report_format'); 
               $item=$this->input->post('item');
               $branch_id=$this->input->post('d_id');   
               $data['f_date']=$f_date;
               $data['to_date']=$to_date; 
               $data['item_id']=$item;
              
               $data['project_id']=$branch_id;
               $where='';
                if(!empty($item_id)){
                    $data['item_id']=$item_id;
                     if(empty($where)){
                         $where.="i.id=$item_id";
                     }else{
                         $where.=" and i.id=$item_id";
                     }
                }else{
                   $data['item_id']=''; 
                }
               
               $sql="select i.*,ig.item_group as item_category,ic.c_name,tmu.meas_unit,tzu.unit_name from items i left join item_groups ig on i.item_group=ig.id left join item_category ic on i.item_category=ic.c_id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tzu on i.size_unit_id=tzu.size_unit_id";
               $data['items']=$this->m_common->customeQuery($sql); 

               $all_items=array();
        $i=0;
        foreach($data['items'] as $key=>$item){
            $data['items'][$key]['item_brands']='';
            $item_brands=unserialize($item['brand_id']);
            $br='';
            if(!empty($item_brands)){
                foreach($item_brands as $brand){
                
                    
                            $opeing_info=array();
                            $ope_sql="select sum(opening_stock) as total_opening_stock from tbl_item_opening_stock where item_id=".$item['id']." and brand_id=".$brand." and unit_id=$branch_id";
                            $opeing_info=$this->m_common->customeQuery($ope_sql);

                            if(!empty($opeing_info)){
                                 $opening_qty=$opeing_info[0]['total_opening_stock'];
                            }else{

                                 $opening_qty=0;
                            }

                            $rec_info=array();

                            $re_sql="select sum(mrrd.receive_qty) as total_receive from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id where mrr.mrr_status='received' and mrrd.receive_date>='2021-01-01' and mrr.unit_id=".$branch_id." and mrrd.item_id=".$item['id']." and mrrd.brand_id=".$brand;
                            $rec_info=$this->m_common->customeQuery($re_sql);
                            if(!empty($rec_info)){
                                $recive_qty=$rec_info[0]['total_receive'];
                            }else{
                                $recive_qty=0;
                            }

                            $cons_info=array();
                            $cons_sql="select sum(consumption_quantity) as total_consumption from  tbl_item_comsumption  where status='Approved' and unit_id=".$branch_id." and item_id=".$item['id']." and brand_id=".$brand;
                            $cons_info=$this->m_common->customeQuery($cons_sql);
                            if(!empty($cons_info)){
                                $consumption_qty=$cons_info[0]['total_consumption'];
                            }else{
                                $consumption_qty=0;
                            }


                            $adjustment_info=array();
                            $adj_sql="select sum(qty) as total_adjustment from  tbl_item_adjustment  where is_active=1 and status='Confirmed' and unit_id=".$branch_id." and item_id=".$item['id']." and brand_id=".$brand;
                            $adjustment_info=$this->m_common->customeQuery($adj_sql);
                            if(!empty($adjustment_info)){
                                $adj_qty=$adjustment_info[0]['total_adjustment'];
                            }else{
                                $adj_qty=0;
                            }

                            $stock_amount=$opening_qty+$recive_qty+$adj_qty-$consumption_qty;
                            if($stock_amount>0){
                                $all_items[$i]['item_name']=$item['item_name'];
                                $all_items[$i]['item_category']=$item['item_category'];
                                $all_items[$i]['c_name']=$item['c_name'];
                                $all_items[$i]['meas_unit']=$item['meas_unit'];
                                $all_items[$i]['max_level']=$item['max_level'];
                                $all_items[$i]['order_level']=$item['order_level'];
                                $all_items[$i]['min_level']=$item['min_level'];
                                $all_items[$i]['stock_amount']=$stock_amount;
                                $brand_info=array();
                                $brand_info= $this->m_common->get_row_array('tbl_item_brand',array('is_active'=>1,'id'=>$brand), '*');
                                
                                $all_items[$i]['item_brands']=$brand_info[0]['brand_name'];
                                $i++;
                            }


//                            $data['items'][$key]['stock_amount']=$opening_qty+$recive_qty+$adj_qty-$consumption_qty;
//                            if($data['items'][$key]['stock_amount']<=0){
//                                unset($data['items'][$key]);
//                            }
                        
                    
                
            }
            }else{
                                                  
                $opeing_info=array();
                $ope_sql="select sum(opening_stock) as total_opening_stock from tbl_item_opening_stock where item_id=".$item['id']." and unit_id=$branch_id";
                $opeing_info=$this->m_common->customeQuery($ope_sql);

                if(!empty($opeing_info)){
                     $opening_qty=$opeing_info[0]['total_opening_stock'];
                }else{

                     $opening_qty=0;
                }

                $rec_info=array();

                $re_sql="select sum(mrrd.receive_qty) as total_receive from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id where mrr.mrr_status='received' and mrrd.receive_date>='2021-01-01' and mrr.unit_id=".$branch_id." and mrrd.item_id=".$item['id'];
                $rec_info=$this->m_common->customeQuery($re_sql);
                if(!empty($rec_info)){
                    $recive_qty=$rec_info[0]['total_receive'];
                }else{
                    $recive_qty=0;
                }

                $cons_info=array();
                $cons_sql="select sum(consumption_quantity) as total_consumption from  tbl_item_comsumption  where status='Approved' and unit_id=".$branch_id." and item_id=".$item['id'];
                $cons_info=$this->m_common->customeQuery($cons_sql);
                if(!empty($cons_info)){
                    $consumption_qty=$cons_info[0]['total_consumption'];
                }else{
                    $consumption_qty=0;
                }


                $adjustment_info=array();
                $adj_sql="select sum(qty) as total_adjustment from  tbl_item_adjustment  where is_active=1 and status='Confirmed' and unit_id=".$branch_id." and item_id=".$item['id'];
                $adjustment_info=$this->m_common->customeQuery($adj_sql);
                if(!empty($adjustment_info)){
                    $adj_qty=$adjustment_info[0]['total_adjustment'];
                }else{
                    $adj_qty=0;
                }

                $stock_amount=$opening_qty+$recive_qty+$adj_qty-$consumption_qty;
                if($stock_amount>0){
                    $all_items[$i]['item_name']=$item['item_name'];
                    $all_items[$i]['item_category']=$item['item_category'];
                    $all_items[$i]['c_name']=$item['c_name'];
                    $all_items[$i]['meas_unit']=$item['meas_unit'];
                    $all_items[$i]['max_level']=$item['max_level'];
                    $all_items[$i]['order_level']=$item['order_level'];
                    $all_items[$i]['min_level']=$item['min_level'];
                    $all_items[$i]['stock_amount']=$stock_amount;
                    $all_items[$i]['item_brands']='NA';
                    $i++;
                }



                        
                    
                
            
            }
            
            reset($brands);
            
            $branch_item_info=array();
            

            
            
        }
        
        $data['all_items']=$all_items;

              $this->load->view('report/materialstock_report',$data);  
           //   $this->load->view('general_store/v_item_stock',$data);

              $data['projects']=$this->m_common->get_row_array('department','','*');

        }else{
            
               $data['project_id']=$branch_id; 
               $sql="select i.*,ig.item_group as item_category,ic.c_name,tmu.meas_unit,tzu.unit_name from items i left join item_groups ig on i.item_group=ig.id left join item_category ic on i.item_category=ic.c_id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tzu on i.size_unit_id=tzu.size_unit_id";
               $data['items']=$this->m_common->customeQuery($sql); 

            $all_items=array();
        $i=0;
        foreach($data['items'] as $key=>$item){
            $data['items'][$key]['item_brands']='';
            $item_brands=unserialize($item['brand_id']);
            $br='';
            if(!empty($item_brands)){
                foreach($item_brands as $brand){
                
                    
                            $opeing_info=array();
                            $ope_sql="select sum(opening_stock) as total_opening_stock from tbl_item_opening_stock where item_id=".$item['id']." and brand_id=".$brand." and unit_id=$branch_id";
                            $opeing_info=$this->m_common->customeQuery($ope_sql);

                            if(!empty($opeing_info)){
                                 $opening_qty=$opeing_info[0]['total_opening_stock'];
                            }else{

                                 $opening_qty=0;
                            }

                            $rec_info=array();

                            $re_sql="select sum(mrrd.receive_qty) as total_receive from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id where mrr.mrr_status='received' and mrrd.receive_date>='2021-01-01' and mrr.unit_id=".$branch_id." and mrrd.item_id=".$item['id']." and mrrd.brand_id=".$brand;
                            $rec_info=$this->m_common->customeQuery($re_sql);
                            if(!empty($rec_info)){
                                $recive_qty=$rec_info[0]['total_receive'];
                            }else{
                                $recive_qty=0;
                            }

                            $cons_info=array();
                            $cons_sql="select sum(consumption_quantity) as total_consumption from  tbl_item_comsumption  where status='Approved' and unit_id=".$branch_id." and item_id=".$item['id']." and brand_id=".$brand;
                            $cons_info=$this->m_common->customeQuery($cons_sql);
                            if(!empty($cons_info)){
                                $consumption_qty=$cons_info[0]['total_consumption'];
                            }else{
                                $consumption_qty=0;
                            }


                            $adjustment_info=array();
                            $adj_sql="select sum(qty) as total_adjustment from  tbl_item_adjustment  where is_active=1 and status='Confirmed' and unit_id=".$branch_id." and item_id=".$item['id']." and brand_id=".$brand;
                            $adjustment_info=$this->m_common->customeQuery($adj_sql);
                            if(!empty($adjustment_info)){
                                $adj_qty=$adjustment_info[0]['total_adjustment'];
                            }else{
                                $adj_qty=0;
                            }

                            $stock_amount=$opening_qty+$recive_qty+$adj_qty-$consumption_qty;
                            if($stock_amount>0){
                                $all_items[$i]['item_name']=$item['item_name'];
                                $all_items[$i]['item_category']=$item['item_category'];
                                $all_items[$i]['c_name']=$item['c_name'];
                                $all_items[$i]['meas_unit']=$item['meas_unit'];
                                $all_items[$i]['max_level']=$item['max_level'];
                                $all_items[$i]['order_level']=$item['order_level'];
                                $all_items[$i]['min_level']=$item['min_level'];
                                $all_items[$i]['stock_amount']=$stock_amount;
                                $brand_info=array();
                                $brand_info= $this->m_common->get_row_array('tbl_item_brand',array('is_active'=>1,'id'=>$brand), '*');
                                
                                $all_items[$i]['item_brands']=$brand_info[0]['brand_name'];
                                $i++;
                            }


//                            $data['items'][$key]['stock_amount']=$opening_qty+$recive_qty+$adj_qty-$consumption_qty;
//                            if($data['items'][$key]['stock_amount']<=0){
//                                unset($data['items'][$key]);
//                            }
                        
                    
                
            }
            }else{
                                                  
                $opeing_info=array();
                $ope_sql="select sum(opening_stock) as total_opening_stock from tbl_item_opening_stock where item_id=".$item['id']." and unit_id=$branch_id";
                $opeing_info=$this->m_common->customeQuery($ope_sql);

                if(!empty($opeing_info)){
                     $opening_qty=$opeing_info[0]['total_opening_stock'];
                }else{

                     $opening_qty=0;
                }

                $rec_info=array();

                $re_sql="select sum(mrrd.receive_qty) as total_receive from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id where mrr.mrr_status='received' and mrrd.receive_date>='2021-01-01' and mrr.unit_id=".$branch_id." and mrrd.item_id=".$item['id'];
                $rec_info=$this->m_common->customeQuery($re_sql);
                if(!empty($rec_info)){
                    $recive_qty=$rec_info[0]['total_receive'];
                }else{
                    $recive_qty=0;
                }

                $cons_info=array();
                $cons_sql="select sum(consumption_quantity) as total_consumption from  tbl_item_comsumption  where status='Approved' and unit_id=".$branch_id." and item_id=".$item['id'];
                $cons_info=$this->m_common->customeQuery($cons_sql);
                if(!empty($cons_info)){
                    $consumption_qty=$cons_info[0]['total_consumption'];
                }else{
                    $consumption_qty=0;
                }


                $adjustment_info=array();
                $adj_sql="select sum(qty) as total_adjustment from  tbl_item_adjustment  where is_active=1 and status='Confirmed' and unit_id=".$branch_id." and item_id=".$item['id'];
                $adjustment_info=$this->m_common->customeQuery($adj_sql);
                if(!empty($adjustment_info)){
                    $adj_qty=$adjustment_info[0]['total_adjustment'];
                }else{
                    $adj_qty=0;
                }

                $stock_amount=$opening_qty+$recive_qty+$adj_qty-$consumption_qty;
                if($stock_amount>0){
                    $all_items[$i]['item_name']=$item['item_name'];
                    $all_items[$i]['item_category']=$item['item_category'];
                    $all_items[$i]['c_name']=$item['c_name'];
                    $all_items[$i]['meas_unit']=$item['meas_unit'];
                    $all_items[$i]['max_level']=$item['max_level'];
                    $all_items[$i]['order_level']=$item['order_level'];
                    $all_items[$i]['min_level']=$item['min_level'];
                    $all_items[$i]['stock_amount']=$stock_amount;
                    $all_items[$i]['item_brands']='NA';
                    $i++;
                }



                        
                    
                
            
            }
            
            reset($brands);
            
            $branch_item_info=array();
            

            
            
        }
        
        $data['all_items']=$all_items;  
            
            $data['products']=$this->m_common->get_row_array('items','','*');
            $data['projects']=$this->m_common->get_row_array('department','','*');
            $this->load->view('report/materialstock_report',$data);
         
       
        }
        
    }
    function materialStockValue($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $item=$this->input->post('item');
           $data['f_date']=$f_date;
           $data['to_date']=$to_date; 
           $data['item_id']=$item;
           $data['item_check']=$item;
           $data['projects']=$this->m_common->get_row_array('department','','*');             
        }else{
          
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $this->load->view('report/materialstockvalue_report',$data);
         
       
        }
        
    }
    
    function materialRequisitionReport($print=false){
        $this->menu='general_store';
        $this->sub_menu = 'report';
        $postData = $this->input->post();
        $branch_id= $this->session->userdata('companyId');
        $where='';
       // $where="imi.department_id=$branch_id";
        $postData = $this->input->post();
        
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $item=$this->input->post('item');
           
          
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');        
           $project_id=$this->input->post('d_id');      
           $item_id=$this->input->post('item_id');
           $status=$this->input->post('status');
           
           
           if(!empty($status)){
               $data['status']=$status;
                if(empty($where)){
                    $where.="imi.status='$status'";
                }else{
                    $where.=" and imi.status='$status'";
                }
           }else{
               $data['status']='';
           }
           
           if(!empty($project_id)){
               $data['project_id']=$project_id;
                if(empty($where)){
                    $where.="imi.department_id=$project_id";
                }else{
                    $where.=" and imi.department_id=$project_id";
                }
           }else{
               $data['project_id']='';
           }
           
           
           
           if(!empty($item_id)){
               $data['item_id']=$item_id;
                if(empty($where)){
                    $where.="imid.item_id=$item_id";
                }else{
                    $where.=" and imid.item_id=$item_id";
                }
           }else{
              $data['item_id']=''; 
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
           }else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           if(!empty($f_date) & !empty($to_date)){
             if(!empty($where)){  
                $sql="select imid.*,imi.ipo_number,imi.date,imi.status,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from ipo_material_indent_details imid left join ipo_material_indent imi on imid.ipo_m_id=imi.ipo_m_id left join department d on imid.department_id=d.d_id left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where and imi.date>='".$from_date."' and imi.date<='".$too_date."' order by imi.date ASC"; 
             }else{
                $sql="select imid.*,imi.ipo_number,imi.date,imi.status,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from ipo_material_indent_details imid left join ipo_material_indent imi on imid.ipo_m_id=imi.ipo_m_id left join department d on imid.department_id=d.d_id left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where imi.date>='".$from_date."' and imi.date<='".$too_date."' order by imi.date ASC";  
             }
           }else if(!empty($f_date)){
              if(!empty($where)){ 
                $sql="select imid.*,imi.ipo_number,imi.date,imi.status,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from ipo_material_indent_details imid left join ipo_material_indent imi on imid.ipo_m_id=imi.ipo_m_id left join department d on imid.department_id=d.d_id left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where and imi.date>='".$from_date."' and imi.date<='".$too_date."' order by imi.date ASC";  
              }else{
                $sql="select imid.*,imi.ipo_number,imi.date,imi.status,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from ipo_material_indent_details imid left join ipo_material_indent imi on imid.ipo_m_id=imi.ipo_m_id left join department d on imid.department_id=d.d_id left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where imi.date>='".$from_date."' and imi.date<='".$too_date."' order by imi.date ASC";    
              }
           }else if(!empty($to_date)){
              if(!empty($where)){ 
                $sql="select imid.*,imi.ipo_number,imi.date,imi.status,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from ipo_material_indent_details imid left join ipo_material_indent imi on imid.ipo_m_id=imi.ipo_m_id left join department d on imid.department_id=d.d_id left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where and imi.date>='".$from_date."' and imi.date<='".$too_date."' order by imi.date ASC";   
              }else{
                $sql="select imid.*,imi.ipo_number,imi.date,imi.status,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from ipo_material_indent_details imid left join ipo_material_indent imi on imid.ipo_m_id=imi.ipo_m_id left join department d on imid.department_id=d.d_id left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where imi.date>='".$from_date."' and imi.date<='".$too_date."' order by imi.date ASC";     
              }
           }else{
              if(!empty($where)){
                $sql="select imid.*,imi.ipo_number,imi.date,imi.status,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from ipo_material_indent_details imid left join ipo_material_indent imi on imid.ipo_m_id=imi.ipo_m_id left join department d on imid.department_id=d.d_id left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where order by imi.date ASC";
              }else{
                $sql="select imid.*,imi.ipo_number,imi.date,imi.status,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from ipo_material_indent_details imid left join ipo_material_indent imi on imid.ipo_m_id=imi.ipo_m_id left join department d on imid.department_id=d.d_id left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id order by imi.date ASC";  
              }
           }
           $data['requisitions']=$this->m_common->customeQuery($sql);   
           
           $data['projects']=$this->m_common->get_row_array('department','','*');   
           $data['products']=$this->m_common->get_row_array('items','','*');
           $this->load->view('report/materialrequisition_report',$data);
           
        }else{          
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $sql="select imid.*,imi.ipo_number,imi.date,imi.status,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from ipo_material_indent_details imid left join ipo_material_indent imi on imid.ipo_m_id=imi.ipo_m_id left join department d on imid.department_id=d.d_id left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where imi.status!='Rejected' ";
           $data['requisitions']=$this->m_common->customeQuery($sql);
           $this->load->view('report/materialrequisition_report',$data);
         
       
        }
        
    }
    
    function materialRequisitionValueReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $item=$this->input->post('item');
           $data['f_date']=$f_date;
           $data['to_date']=$to_date; 
           $data['item_id']=$item;
           $data['item_check']=$item;
           $data['projects']=$this->m_common->get_row_array('department','','*');
    
                
               
           
             
        }else{
          
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $this->load->view('report/materialrequisitionvalue_report',$data);
         
       
        }
        
    }
    function materialBudgetReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $postData = $this->input->post();
        $branch_id= $this->session->userdata('companyId');
        $where='';
       // $where="imi.department_id=$branch_id";
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $item=$this->input->post('item');
           
          
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');        
           $project_id=$this->input->post('d_id');      
           $item_id=$this->input->post('item_id');
           $status=$this->input->post('status');
           
           
           if(!empty($status)){
               $data['status']=$status;
                if(empty($where)){
                    $where.="b.b_approve_status='$status'";
                }else{
                    $where.=" and b.b_approve_status='$status'";
                }
           }else{
               $data['status']='';
           }
           
           if(!empty($project_id)){
               $data['project_id']=$project_id;
                if(empty($where)){
                    $where.="bd.department_id=$project_id";
                }else{
                    $where.=" and bd.department_id=$project_id";
                }
           }else{
               $data['project_id']='';
           }
           
           
           
           if(!empty($item_id)){
               $data['item_id']=$item_id;
                if(empty($where)){
                    $where.="bd.item_id=$item_id";
                }else{
                    $where.=" and bd.item_id=$item_id";
                }
           }else{
              $data['item_id']=''; 
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
           }else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           if(!empty($f_date) & !empty($to_date)){
             if(!empty($where)){  
                $sql="select bd.*,b.b_no,b.b_date,b.b_approve_status,i.item_name,tmu.meas_unit,tsu.unit_name from budget_details bd left join budget b on bd.b_id=b.b_id left join items i on bd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where and b.b_date>='".$from_date."' and b.b_date<='".$too_date."' order by b.b_date ASC"; 
             }else{
                $sql="select bd.*,b.b_no,b.b_date,b.b_approve_status,i.item_name,tmu.meas_unit,tsu.unit_name from budget_details bd left join budget b on bd.b_id=b.b_id left join items i on bd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where b.b_date>='".$from_date."' and b.b_date<='".$too_date."' order by b.b_date ASC";  
             }
           }else if(!empty($f_date)){
              if(!empty($where)){ 
                $sql="select bd.*,b.b_no,b.b_date,b.b_approve_status,i.item_name,tmu.meas_unit,tsu.unit_name from budget_details bd left join budget b on bd.b_id=b.b_id left join items i on bd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where and b.b_date>='".$from_date."' and b.b_date<='".$too_date."' order by b.b_date ASC";  
              }else{
                $sql="select bd.*,b.b_no,b.b_date,b.b_approve_status,i.item_name,tmu.meas_unit,tsu.unit_name from budget_details bd left join budget b on bd.b_id=b.b_id left join items i on bd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where b.b_date>='".$from_date."' and b.b_date<='".$too_date."' order by b.b_date ASC";    
              }
           }else if(!empty($to_date)){
              if(!empty($where)){ 
                $sql="select bd.*,b.b_no,b.b_date,b.b_approve_status,i.item_name,tmu.meas_unit,tsu.unit_name from budget_details bd left join budget b on bd.b_id=b.b_id left join items i on bd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where and b.b_date>='".$from_date."' and b.b_date<='".$too_date."' order by b.b_date ASC";   
              }else{
                $sql="select bd.*,b.b_no,b.b_date,b.b_approve_status,i.item_name,tmu.meas_unit,tsu.unit_name from budget_details bd left join budget b on bd.b_id=b.b_id left join items i on bd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where b.b_date>='".$from_date."' and b.b_date<='".$too_date."' order by b.b_date ASC";     
              }
           }else{
              if(!empty($where)){
                $sql="select bd.*,b.b_no,b.b_date,b.b_approve_status,i.item_name,tmu.meas_unit,tsu.unit_name from budget_details bd left join budget b on bd.b_id=b.b_id  left join items i on bd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where order by b.b_date ASC";
              }else{
                $sql="select bd.*,b.b_no,b.b_date,b.b_approve_status,i.item_name,tmu.meas_unit,tsu.unit_name from budget_details bd left join budget b on bd.b_id=b.b_id left join items i on bd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id order by b.b_date ASC";  
              }
           }
           $data['budgets']=$this->m_common->customeQuery($sql);           
           $data['projects']=$this->m_common->get_row_array('department','','*');   
           $data['products']=$this->m_common->get_row_array('items','','*');
           $this->load->view('report/materialbudget_report',$data);
           
        }else{
          
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $sql="select bd.*,b.b_no,b.b_date,b.b_approve_status,i.item_name,tmu.meas_unit,tsu.unit_name from budget_details bd left join budget b on bd.b_id=b.b_id  left join items i on bd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where b.b_approve_status!='Rejected' ";
           $data['budgets']=$this->m_common->customeQuery($sql);
           $this->load->view('report/materialbudget_report',$data);
         
       
        }
        
    }
    function materialBudgetValueReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $item=$this->input->post('item');
           $data['f_date']=$f_date;
           $data['to_date']=$to_date; 
           $data['item_id']=$item;
           $data['item_check']=$item;
           $data['projects']=$this->m_common->get_row_array('department','','*');
                 
        }else{
          
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $this->load->view('report/materialbudgetvalue_report',$data);
         
       
        }
        
    }
    
     function mateialWorkOrderReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $branch_id= $this->session->userdata('companyId');
        $where='';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date'); 
           $item_id=$this->input->post('item_id');
           $project_id=$this->input->post('d_id');      
           $supplier_id=$this->input->post('supplier_id');
           $status=$this->input->post('status');
           
           $where.="po.approve_status='Approved' and tit.type_name='Material'";
           if(!empty($project_id)){
               $data['project_id']=$project_id;
                if(empty($where)){
                    $where.="po.unit_id=$project_id";
                }else{
                    $where.=" and po.unit_id=$project_id";
                }
           }else{
               $data['project_id']='';
           }
           
           if(!empty($item_id)){
               $data['item_id']=$item_id;
                if(empty($where)){
                    $where.="pod.item_id=$item_id";
                }else{
                    $where.=" and pod.item_id=$item_id";
                }
           }else{
               $data['item_id']='';
           }
           
           if(!empty($supplier_id)){
               $data['supplier_id']=$supplier_id;
                if(empty($where)){
                    $where.="po.supplier_id=$supplier_id";
                }else{
                    $where.=" and po.supplier_id=$supplier_id";
                }
           }else{
              $data['supplier_id']=''; 
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
           }else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           if(!empty($f_date) & !empty($to_date)){
             if(!empty($where)){  
                $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join items i on pod.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID where $where and po.purchase_order_date>='".$from_date."' and po.purchase_order_date<='".$too_date."' order by po.purchase_order_date ASC"; 
             }else{
                $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join items i on pod.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID where po.purchase_order_date>='".$from_date."' and po.purchase_order_date<='".$too_date."' order by po.purchase_order_date ASC";  
             }
           }else if(!empty($f_date)){
              if(!empty($where)){ 
                $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join items i on pod.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID where $where and po.purchase_order_date>='".$from_date."' and po.purchase_order_date<='".$too_date."' order by po.purchase_order_date ASC";  
              }else{
                $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join items i on pod.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID where po.purchase_order_date>='".$from_date."' and po.purchase_order_date<='".$too_date."' order by po.purchase_order_date ASC";    
              }
           }else if(!empty($to_date)){
              if(!empty($where)){ 
                $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join items i on pod.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID where $where and po.purchase_order_date>='".$from_date."' and po.purchase_order_date<='".$too_date."' order by po.purchase_order_date ASC";   
              }else{
                $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join items i on pod.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID where po.purchase_order_date>='".$from_date."' and po.purchase_order_date<='".$too_date."' order by po.purchase_order_date ASC";     
              }
           }else{
              if(!empty($where)){
                $sql="select select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join items i on pod.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID where $where order by po.purchase_order_date ASC";
              }else{
                $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join items i on pod.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID order by po.purchase_order_date ASC";  
              }
           }
           
           
           $data['purchase_orders']=$this->m_common->customeQuery($sql);
           foreach($data['purchase_orders'] as $key=>$value){
              // $r_sql="select sum(receive_qty) as total_receive_qty from tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id where mrr.po_id=".$value['o_id']." and mrrd.item_id=".$value['item_id'];  //14-01-2021
               $r_sql="select sum(receive_qty) as total_receive_qty from tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id where mrrd.o_details_id=".$value['o_details_id']." and mrrd.item_id=".$value['item_id'];  
               $recive=$this->m_common->customeQuery($r_sql);
               if(!empty($recive)){
                    $data['purchase_orders'][$key]['receive_quantity']=$recive[0]['total_receive_qty'];
                    $data['purchase_orders'][$key]['remaining_quantity']=$value['quantity']-$recive[0]['total_receive_qty'];
               }else{
                   $data['purchase_orders'][$key]['receive_quantity']='';
                   $data['purchase_orders'][$key]['remaining_quantity']=$value['quantity'];
               }
           }
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $this->load->view('report/mateialworkorder_report',$data); 
              
        }else{
          
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join items i on pod.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID where po.approve_status='Approved' ";
           $data['purchase_orders']=$this->m_common->customeQuery($sql);
           foreach($data['purchase_orders'] as $key=>$value){
              // $r_sql="select sum(receive_qty) as total_receive_qty from tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id where mrr.po_id=".$value['o_id']." and mrrd.item_id=".$value['item_id'];  
               $r_sql="select sum(receive_qty) as total_receive_qty from tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id where mrrd.o_details_id=".$value['o_details_id']." and mrrd.item_id=".$value['item_id']; 
               $recive=$this->m_common->customeQuery($r_sql);
               if(!empty($recive)){
                    $data['purchase_orders'][$key]['receive_quantity']=$recive[0]['total_receive_qty'];
                    $data['purchase_orders'][$key]['remaining_quantity']=$value['quantity']-$recive[0]['total_receive_qty'];
               }else{
                   $data['purchase_orders'][$key]['receive_quantity']='';
                   $data['purchase_orders'][$key]['remaining_quantity']=$value['quantity'];
               }
           }
           $this->load->view('report/mateialworkorder_report',$data);
         
       
        }
        
    }
    function pendingIndentReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $branch_id= $this->session->userdata('companyId');
        $where='';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date'); 
           $item_id=$this->input->post('item_id');
           $project_id=$this->input->post('d_id');      
          
           $status=$this->input->post('status');
           
           $where.="imid.department_id=$branch_id";

           
           if(!empty($item_id)){
               $data['item_id']=$item_id;
                if(empty($where)){
                    $where.="imid.item_id=$item_id";
                }else{
                    $where.=" and imid.item_id=$item_id";
                }
           }else{
               $data['item_id']='';
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
           }else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           if(!empty($f_date) & !empty($to_date)){             
                $sql="select imid.*,i.item_name,tmu.meas_unit,tib.brand_name from ipo_material_indent_details imid left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_item_brand tib on imid.brand_id=tib.id where $where and imid.indent_date>='".$from_date."' and imid.indent_date<='".$too_date."' order by imid.indent_date DESC";                        
           }else{
                $sql="select imid.*,i.item_name,tmu.meas_unit,tib.brand_name from ipo_material_indent_details imid left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_item_brand tib on imid.brand_id=tib.id where $where  order by imid.indent_date DESC";            
           }
           
           
           $data['indents']=$this->m_common->customeQuery($sql);
           foreach($data['indents'] as $key=>$value){
               $r_sql="select sum(receive_qty) as total_receive_qty from tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id where mrrd.indent_d_id=".$value['id'];  
               $recive=$this->m_common->customeQuery($r_sql);
               if(!empty($recive)){
                    $data['indents'][$key]['receive_quantity']=$recive[0]['total_receive_qty'];
                    $data['indents'][$key]['remaining_quantity']=$value['indent_qty']-$recive[0]['total_receive_qty'];
               }else{
                   $data['indents'][$key]['receive_quantity']='';
                   $data['indents'][$key]['remaining_quantity']=$value['indent_qty'];
               }
               if($data['indents'][$key]['remaining_quantity']==0){
                   unset($data['indents'][$key]);
               }
           }
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $this->load->view('report/pending_indent_report',$data); 
              
        }else{
          
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $sql="select imid.*,i.item_name,tmu.meas_unit,tib.brand_name from ipo_material_indent_details imid left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_item_brand tib on imid.brand_id=tib.id order by imid.indent_date DESC"; 
           $data['indents']=$this->m_common->customeQuery($sql);
           foreach($data['indents'] as $key=>$value){
               $r_sql="select sum(receive_qty) as total_receive_qty from tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id where mrrd.indent_d_id=".$value['id']; 
               $recive=$this->m_common->customeQuery($r_sql);
               if(!empty($recive)){
                    $data['indents'][$key]['receive_quantity']=$recive[0]['total_receive_qty'];
                    $data['indents'][$key]['remaining_quantity']=$value['indent_qty']-$recive[0]['total_receive_qty'];
               }else{
                   $data['indents'][$key]['receive_quantity']='';
                   $data['indents'][$key]['remaining_quantity']=$value['indent_qty'];
               }
               if($data['indents'][$key]['remaining_quantity']==0){
                   unset($data['indents'][$key]);
               }
           }
           $this->load->view('report/pending_indent_report',$data);
         
       
        }
        
    }
    
    function pendingMoneyIndentReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $branch_id= $this->session->userdata('companyId');
        $where='';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date'); 
           $item_id=$this->input->post('item_id');
           $project_id=$this->input->post('d_id');      
          
           $status=$this->input->post('status');
           
           $where.="imid.is_active=1 and tmi.branch_id=$branch_id";

           
           if(!empty($item_id)){
               $data['item_id']=$item_id;
                if(empty($where)){
                    $where.="imid.item_id=$item_id";
                }else{
                    $where.=" and imid.item_id=$item_id";
                }
           }else{
               $data['item_id']='';
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
           }else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           if(!empty($f_date) & !empty($to_date)){             
                $sql="select imid.*,tmi.mo_indent_no,tmi.date,i.item_name,tmu.meas_unit,tib.brand_name from tbl_money_indent_details imid left join tbl_money_indent tmi on imid.mi_id=tmi.mi_id left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_item_brand tib on imid.brand_id=tib.id where $where and tmi.date>='".$from_date."' and tmi.date<='".$too_date."' order by tmi.date DESC";                        
           }else{
                $sql="select imid.*,tmi.mo_indent_no,tmi.date,i.item_name,tmu.meas_unit,tib.brand_name from tbl_money_indent_details imid left join tbl_money_indent tmi on imid.mi_id=tmi.mi_id left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_item_brand tib on imid.brand_id=tib.id where $where  order by tmi.date DESC";            
           }
           
           
           $data['indents']=$this->m_common->customeQuery($sql);
           foreach($data['indents'] as $key=>$value){
               $r_sql="select sum(receive_qty) as total_receive_qty,sum(mrrd.amount) as total_amount from tbl_material_receive_requisition_details mrrd left join tbl_purchase_order_details tpod on mrrd.o_details_id=tpod.o_details_id where tpod.mi_d_id=".$value['mi_d_id']; 
               $recive=$this->m_common->customeQuery($r_sql);
               if(!empty($recive)){
                    $data['indents'][$key]['receive_quantity']=$recive[0]['total_receive_qty'];
                    $data['indents'][$key]['remaining_quantity']=$value['quantity']-$recive[0]['total_receive_qty'];
                    
                    $data['indents'][$key]['receive_value']=$recive[0]['total_amount'];
                    $data['indents'][$key]['remaining_value']=$value['value']-$recive[0]['total_amount'];
                  
                    
               }else{
                   $data['indents'][$key]['receive_quantity']='';
                   $data['indents'][$key]['remaining_quantity']=$value['quantity'];
                   
                   $data['indents'][$key]['receive_value']='';
                   $data['indents'][$key]['remaining_value']=$value['value'];
               }
               if($data['indents'][$key]['remaining_quantity']==0){
                   unset($data['indents'][$key]);
               }
           }
            
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $this->load->view('report/pending_money_indent_report',$data); 
              
        }else{
          
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $sql="select imid.*,tmi.mo_indent_no,tmi.date,i.item_name,tmu.meas_unit,tib.brand_name from tbl_money_indent_details imid left join tbl_money_indent tmi on imid.mi_id=tmi.mi_id left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_item_brand tib on imid.brand_id=tib.id where imid.is_active=1 order by tmi.date DESC"; 
           $data['indents']=$this->m_common->customeQuery($sql);
           foreach($data['indents'] as $key=>$value){
              
               $r_sql="select sum(receive_qty) as total_receive_qty,sum(mrrd.amount) as total_amount from tbl_material_receive_requisition_details mrrd left join tbl_purchase_order_details tpod on mrrd.o_details_id=tpod.o_details_id where tpod.mi_d_id=".$value['mi_d_id']; 
               $recive=$this->m_common->customeQuery($r_sql);
               if(!empty($recive)){
                   $data['indents'][$key]['receive_quantity']=$recive[0]['total_receive_qty'];
                   $data['indents'][$key]['remaining_quantity']=$value['quantity']-$recive[0]['total_receive_qty'];
                   
                   $data['indents'][$key]['receive_value']=$recive[0]['total_amount'];
                   $data['indents'][$key]['remaining_value']=$value['value']-$recive[0]['total_amount'];
                   
               }else{
                   $data['indents'][$key]['receive_quantity']='';
                   $data['indents'][$key]['remaining_quantity']=$value['quantity'];
                   
                   $data['indents'][$key]['receive_value']='';
                   $data['indents'][$key]['remaining_value']=$value['value'];
               }
               
               if($data['indents'][$key]['remaining_quantity']==0){
                   unset($data['indents'][$key]);
               }
               
           }
           
           $this->load->view('report/pending_money_indent_report',$data);
         
       
        }
        
    }
    
    function pendingBudgetReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $branch_id= $this->session->userdata('companyId');
        $where='';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date'); 
           $item_id=$this->input->post('item_id');
           $project_id=$this->input->post('d_id');      
          
           $status=$this->input->post('status');
           
           $where.="imid.department_id=$branch_id";

           
           if(!empty($item_id)){
               $data['item_id']=$item_id;
                if(empty($where)){
                    $where.="imid.item_id=$item_id";
                }else{
                    $where.=" and imid.item_id=$item_id";
                }
           }else{
               $data['item_id']='';
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
           }else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           if(!empty($f_date) & !empty($to_date)){             
                $sql="select imid.*,i.item_name,tmu.meas_unit,tib.brand_name from budget_details imid left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_item_brand tib on imid.brand_id=tib.id where $where and imid.b_date>='".$from_date."' and imid.b_date<='".$too_date."' order by imid.b_date DESC";                        
           }else{
                $sql="select imid.*,i.item_name,tmu.meas_unit,tib.brand_name from budget_details imid left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_item_brand tib on imid.brand_id=tib.id where $where  order by imid.date DESC";            
           }
           
           
           $data['indents']=$this->m_common->customeQuery($sql);
           foreach($data['indents'] as $key=>$value){
               $r_sql="select sum(receive_qty) as total_receive_qty,sum(mrrd.amount) as total_amount from tbl_material_receive_requisition_details mrrd left join tbl_purchase_order_details tpod on mrrd.o_details_id=tpod.o_details_id where tpod.bu_d_id=".$value['bu_d_id']; 
               $recive=$this->m_common->customeQuery($r_sql);
               if(!empty($recive)){
                    $data['indents'][$key]['receive_quantity']=$recive[0]['total_receive_qty'];
                    $data['indents'][$key]['remaining_quantity']=$value['budget_qty']-$recive[0]['total_receive_qty'];
                    
                    $data['indents'][$key]['receive_value']=$recive[0]['total_amount'];
                    $data['indents'][$key]['remaining_value']=$value['budget_value']-$recive[0]['total_amount'];
                  
                    
               }else{
                   $data['indents'][$key]['receive_quantity']='';
                   $data['indents'][$key]['remaining_quantity']=$value['budget_qty'];
                   
                   $data['indents'][$key]['receive_value']='';
                   $data['indents'][$key]['remaining_value']=$value['budget_value'];
               }
               if($data['indents'][$key]['remaining_quantity']==0){
                   unset($data['indents'][$key]);
               }
           }
            
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $this->load->view('report/pending_budget_report',$data); 
              
        }else{
          
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $sql="select imid.*,i.item_name,tmu.meas_unit,tib.brand_name from budget_details imid left join items i on imid.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_item_brand tib on imid.brand_id=tib.id order by imid.b_date DESC"; 
           $data['indents']=$this->m_common->customeQuery($sql);
           foreach($data['indents'] as $key=>$value){
              
               $r_sql="select sum(receive_qty) as total_receive_qty,sum(mrrd.amount) as total_amount from tbl_material_receive_requisition_details mrrd left join tbl_purchase_order_details tpod on mrrd.o_details_id=tpod.o_details_id where tpod.bu_d_id=".$value['bu_d_id']; 
               $recive=$this->m_common->customeQuery($r_sql);
               if(!empty($recive)){
                   $data['indents'][$key]['receive_quantity']=$recive[0]['total_receive_qty'];
                   $data['indents'][$key]['remaining_quantity']=$value['budget_qty']-$recive[0]['total_receive_qty'];
                   
                   $data['indents'][$key]['receive_value']=$recive[0]['total_amount'];
                   $data['indents'][$key]['remaining_value']=$value['budget_value']-$recive[0]['total_amount'];
                   
               }else{
                   $data['indents'][$key]['receive_quantity']='';
                   $data['indents'][$key]['remaining_quantity']=$value['budget_qty'];
                   
                   $data['indents'][$key]['receive_value']='';
                   $data['indents'][$key]['remaining_value']=$value['budget_value'];
               }
               
               if($data['indents'][$key]['remaining_quantity']==0){
                   unset($data['indents'][$key]);
               }
               
           }
           
           $this->load->view('report/pending_budget_report',$data);
         
       
        }
        
    }
    
    
    function mateialWOrkorderValueReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $item=$this->input->post('item');
           $data['f_date']=$f_date;
           $data['to_date']=$to_date; 
           $data['item_id']=$item;
           $data['item_check']=$item;
           $data['projects']=$this->m_common->get_row_array('department','','*');
                      
        }else{
          
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $this->load->view('report/mateialworkordervalue_report',$data);
         
       
        }
        
    }
    function ServiceWorkOrder($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $branch_id= $this->session->userdata('companyId');
        $where='';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');        
           $project_id=$this->input->post('d_id');      
           $supplier_id=$this->input->post('supplier_id');
           $status=$this->input->post('status');
           
           $where.="po.approve_status='Approved' and tit.type_name='Sub Contractor Job'";
           if(!empty($project_id)){
               $data['project_id']=$project_id;
                if(empty($where)){
                    $where.="po.unit_id=$project_id";
                }else{
                    $where.=" and po.unit_id=$project_id";
                }
           }else{
               $data['project_id']='';
           }
           
           
           
           if(!empty($supplier_id)){
               $data['supplier_id']=$supplier_id;
                if(empty($where)){
                    $where.="po.supplier_id=$supplier_id";
                }else{
                    $where.=" and po.supplier_id=$supplier_id";
                }
           }else{
              $data['supplier_id']=''; 
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
           }else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           if(!empty($f_date) & !empty($to_date)){
             if(!empty($where)){  
                $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,ts.service_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join tbl_services ts on pod.service_id=ts.id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID where $where and po.purchase_order_date>='".$from_date."' and po.purchase_order_date<='".$too_date."' order by po.purchase_order_date ASC"; 
             }else{
                $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,ts.service_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join tbl_services ts on pod.service_id=ts.id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID where po.purchase_order_date>='".$from_date."' and po.purchase_order_date<='".$too_date."' order by po.purchase_order_date ASC";  
             }
           }else if(!empty($f_date)){
              if(!empty($where)){ 
                $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,ts.service_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join tbl_services ts on pod.service_id=ts.id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID where $where and po.purchase_order_date>='".$from_date."' and po.purchase_order_date<='".$too_date."' order by po.purchase_order_date ASC";  
              }else{
                $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,ts.service_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join tbl_services ts on pod.service_id=ts.id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID where po.purchase_order_date>='".$from_date."' and po.purchase_order_date<='".$too_date."' order by po.purchase_order_date ASC";    
              }
           }else if(!empty($to_date)){
              if(!empty($where)){ 
                $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,ts.service_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join tbl_services ts on pod.service_id=ts.id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID where $where and po.purchase_order_date>='".$from_date."' and po.purchase_order_date<='".$too_date."' order by po.purchase_order_date ASC";   
              }else{
                $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,ts.service_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join tbl_services ts on pod.service_id=ts.id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID where po.purchase_order_date>='".$from_date."' and po.purchase_order_date<='".$too_date."' order by po.purchase_order_date ASC";     
              }
           }else{
              if(!empty($where)){
                $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,ts.service_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join tbl_services ts on pod.service_id=ts.id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID where $where order by po.purchase_order_date ASC";
              }else{
                $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,ts.service_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join tbl_services ts on pod.service_id=ts.id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID order by po.purchase_order_date ASC";  
              }
           }
           
           
           $data['purchase_orders']=$this->m_common->customeQuery($sql);
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $this->load->view('report/serviceworkorder_report',$data);
              
        }else{    
            
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $sql="select pod.*,imid.indent_no,po.purchase_order_date,po.order_no,d.dep_description,ts.service_name,s.SUP_NAME from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join tbl_services ts on pod.service_id=ts.id left join tbl_indent_type tit on po.order_type=tit.id left join supplier s on po.supplier_id=s.ID where tit.type_name='Sub Contractor Job' and po.approve_status='Approved' ";
           $data['purchase_orders']=$this->m_common->customeQuery($sql);                      
           $this->load->view('report/serviceworkorder_report',$data);
         
       
        }
        
    }
    function totalMaterialReceived($print=false){
        $this->menu ='general_store';
        $this->sub_menu ='report';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');        
           $project_id=$this->input->post('d_id');      
           $supplier_id=$this->input->post('supplier_id');
           $status=$this->input->post('status');
           $item_id=$this->input->post('item_id');
           
           $brand_id=$this->input->post('brand_id');
           
           $item_info=$this->m_common->get_row_array('items',array('id'=>$item_id),'*');
           $brands= $this->m_common->get_row_array('tbl_item_brand',array('is_active'=>1), '*');
           $item_brands=unserialize($item_info[0]['brand_id']);
           $b=array();
           foreach($brands as $key1=>$brand){
                    if(!empty($item_brands)){  
                        if(in_array($brand['id'],$item_brands)){
                          $b[]=$brand;
                        }else{
                             unset($brands[$key1]);
                        }
                    }else{
                        $b='';
                    }
           }        
            $data['brands']=$b; 
                      
           if(!empty($brand_id)){
              $data['brand_id']=$brand_id; 
           }else{
              $data['brand_id']=''; 
           }
           
           if(!empty($brand_id)){
                $where.="mrr.mrr_status='received' and mrrd.brand_id=".$brand_id;
           }else{
                $where.="mrr.mrr_status='received'";
           }
           
           if(!empty($item_id)){
               $data['item_id']=$item_id;
               if(empty($where)){
                    $where.="mrrd.item_id=$item_id";
                }else{
                    $where.=" and mrrd.item_id=$item_id";
                }
           }else{
               $data['item_id']='';
           }
           
           if(!empty($project_id)){
               $data['project_id']=$project_id;
                if(empty($where)){
                    $where.="mrr.unit_id=$project_id";
                }else{
                    $where.=" and mrr.unit_id=$project_id";
                }
           }else{
               $data['project_id']='';
           }
           
           
           
           if(!empty($supplier_id)){
               $data['supplier_id']=$supplier_id;
                if(empty($where)){
                    $where.="po.supplier_id=$supplier_id";
                }else{
                    $where.=" and po.supplier_id=$supplier_id";
                }
           }else{
              $data['supplier_id']=''; 
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
           }else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           if(!empty($f_date) & !empty($to_date)){
             if(!empty($where)){  
                $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr_challan,mrr.mrr_challan_date,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where and mrr.mrr_date>='".$from_date."' and mrr.mrr_date<='".$too_date."' order by mrr.mrr_date ASC"; 
             }else{
                $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr_challan,mrr.mrr_challan_date,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where mrr.mrr_date>='".$from_date."' and mrr.mrr_date<='".$too_date."' order by mrr.mrr_date ASC";  
             }
           }else if(!empty($f_date)){
              if(!empty($where)){ 
                $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr_challan,mrr.mrr_challan_date,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where and mrr.mrr_date>='".$from_date."' and mrr.mrr_date<='".$too_date."' order by mrr.mrr_date ASC";  
              }else{
                $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr_challan,mrr.mrr_challan_date,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where mrr.mrr_date>='".$from_date."' and mrr.mrr_date<='".$too_date."' order by mrr.mrr_date ASC";    
              }
           }else if(!empty($to_date)){
              if(!empty($where)){ 
                $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr_challan,mrr.mrr_challan_date,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where and mrr.mrr_date>='".$from_date."' and mrr.mrr_date<='".$too_date."' order by mrr.mrr_date ASC";   
              }else{
                $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr_challan,mrr.mrr_challan_date,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where mrr.mrr_date>='".$from_date."' and mrr.mrr_date<='".$too_date."' order by mrr.mrr_date ASC";     
              }
           }else{
              if(!empty($where)){
                $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr.mrr_challan_date,mrr_challan,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join tbl_purchase_orders po on po.o_id=mrr.o_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where order by mrr.mrr_date ASC";
              }else{
                $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr.mrr_challan_date,mrr_challan,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id order by mrr.mrr_date ASC";  
              }
           }
           
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['material_receives']=$this->m_common->customeQuery($sql);
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $this->load->view('report/totalraterialreceived_report',$data);
             
        }else{
           $data['item_id']='';  
           $data['brand_id']='';
           $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr_challan,mrr.mrr_challan_date,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where mrr.mrr_status='received' ";
           $data['material_receives']=$this->m_common->customeQuery($sql); 
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $this->load->view('report/totalraterialreceived_report',$data);
         
       
        }
        
    }
    
    function cashPurchaseReport($print=false){
        $this->menu ='general_store';
        $this->sub_menu ='report';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');        
           $project_id=$this->input->post('d_id');      
           $supplier_id=$this->input->post('supplier_id');
           $status=$this->input->post('status');
           
           $where.="mrr.mrr_status='received' and po.order_from='Money Indent' ";
           if(!empty($project_id)){
               $data['project_id']=$project_id;
                if(empty($where)){
                    $where.="mrr.unit_id=$project_id";
                }else{
                    $where.=" and mrr.unit_id=$project_id";
                }
           }else{
               $data['project_id']='';
           }
           
           
           
           if(!empty($supplier_id)){
               $data['supplier_id']=$supplier_id;
                if(empty($where)){
                    $where.="po.supplier_id=$supplier_id";
                }else{
                    $where.=" and po.supplier_id=$supplier_id";
                }
           }else{
              $data['supplier_id']=''; 
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
           }else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           if(!empty($f_date) & !empty($to_date)){
             if(!empty($where)){  
                $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr_challan,mrr.mrr_challan_date,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no,po.order_from from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where and mrr.mrr_date>='".$from_date."' and mrr.mrr_date<='".$too_date."' order by mrr.mrr_date ASC"; 
             }else{
                $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr_challan,mrr.mrr_challan_date,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no,po.order_from from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where mrr.mrr_date>='".$from_date."' and mrr.mrr_date<='".$too_date."' order by mrr.mrr_date ASC";  
             }
           }else if(!empty($f_date)){
              if(!empty($where)){ 
                $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr_challan,mrr.mrr_challan_date,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no,po.order_from from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where and mrr.mrr_date>='".$from_date."' and mrr.mrr_date<='".$too_date."' order by mrr.mrr_date ASC";  
              }else{
                $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr_challan,mrr.mrr_challan_date,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no,po.order_from from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where mrr.mrr_date>='".$from_date."' and mrr.mrr_date<='".$too_date."' order by mrr.mrr_date ASC";    
              }
           }else if(!empty($to_date)){
              if(!empty($where)){ 
                $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr_challan,mrr.mrr_challan_date,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no,po.order_from from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where and mrr.mrr_date>='".$from_date."' and mrr.mrr_date<='".$too_date."' order by mrr.mrr_date ASC";   
              }else{
                $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr_challan,mrr.mrr_challan_date,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no,po.order_from from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where mrr.mrr_date>='".$from_date."' and mrr.mrr_date<='".$too_date."' order by mrr.mrr_date ASC";     
              }
           }else{
              if(!empty($where)){
                $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr.mrr_challan_date,mrr_challan,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no,po.order_from from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join tbl_purchase_orders po on po.o_id=mrr.o_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where order by mrr.mrr_date ASC";
              }else{
                $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr.mrr_challan_date,mrr_challan,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no,po.order_from from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id order by mrr.mrr_date ASC";  
              }
           }
           
           
           $data['material_receives']=$this->m_common->customeQuery($sql);
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $this->load->view('report/cash_purchase_report',$data);
             
        }else{
              
           $sql="select mrrd.*,mrr.mrr_date,mrr.mrr_no,mrr_challan,mrr.mrr_challan_date,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name,s.SUP_NAME,po.order_no,po.order_from from  tbl_material_receive_requisition_details mrrd left join material_receive_requisition mrr on mrrd.mrr_id=mrr.mrr_id left join tbl_purchase_orders po on po.o_id=mrr.po_id left join supplier s on po.supplier_id=s.ID left join department d on mrr.unit_id=d.d_id left join items i on mrrd.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where po.order_from='Money Indent' and mrr.mrr_status='received' ";
           $data['material_receives']=$this->m_common->customeQuery($sql); 
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $this->load->view('report/cash_purchase_report',$data);
         
       
        }
        
    }
    
    function totalMaterialReceivedValue($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $item=$this->input->post('item');
           $data['f_date']=$f_date;
           $data['to_date']=$to_date; 
           $data['item_id']=$item;
           $data['item_check']=$item;
           $data['projects']=$this->m_common->get_row_array('department','','*');
    
                
               
           
             
        }else{
          
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $this->load->view('report/totalraterialreceivedvalue_report',$data);
         
       
        }
        
    }
    function totalServicecompleted($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $item=$this->input->post('item');
           $data['f_date']=$f_date;
           $data['to_date']=$to_date; 
           $data['item_id']=$item;
           $data['item_check']=$item;
           $data['projects']=$this->m_common->get_row_array('department','','*');
    
                
               
           
             
        }else{
          
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $this->load->view('report/totalservicecompleted_report',$data);
         
       
        }
        
    }
    function materialAverageRate($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $item=$this->input->post('item');
           $data['f_date']=$f_date;
           $data['to_date']=$to_date; 
           $data['item_id']=$item;
           $data['item_check']=$item;
           $data['projects']=$this->m_common->get_row_array('department','','*');
    
                
               
           
             
        }else{
          
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $sql="select pod.*,sum(pod.quantity) as total_qty,sum(pod.amount) as total,d.dep_description,i.item_name,tmu.meas_unit from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join items i on pod.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_indent_type tit on po.order_type=tit.id where po.approve_status='Approved' group by pod.item_id";
           $data['purchase_orders']=$this->m_common->customeQuery($sql);
           $this->load->view('report/materialaveragerate_report',$data);
         
       
        }
        
    }
    function materialTransfer($print=false){
        
       $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $branch_id= $this->session->userdata('companyId');
        $where='';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');        
           $project_id=$this->input->post('d_id');      
           $item_id=$this->input->post('item_id');
           $status=$this->input->post('status');
           
           $where.="tit.status='3'";
           if(!empty($project_id)){
               $data['project_id']=$project_id;
                if(empty($where)){
                    $where.="tit.to_unit_id=$project_id";
                }else{
                    $where.=" and tit.to_unit_id=$project_id";
                }
           }else{
               $data['project_id']='';
           }
           
           
           if(!empty($item_id)){
               $data['item_id']=$item_id;
                if(empty($where)){
                    $where.="tit.item_id=$item_id";
                }else{
                    $where.=" and tit.item_id=$item_id";
                }
           }else{
              $data['item_id']=''; 
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
           }else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           if(!empty($f_date) & !empty($to_date)){
             if(!empty($where)){  
                $sql="select tit.*,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from tbl_item_transfer tit  left join department d on tit.from_unit_id=d.d_id left join items i on tit.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where and tit.transfer_date>='".$from_date."' and tit.transfer_date<='".$too_date."' order by tit.transfer_date ASC"; 
             }else{
                $sql="select tit.*,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from tbl_item_transfer tit  left join department d on tit.from_unit_id=d.d_id left join items i on tit.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where tit.transfer_date>='".$from_date."' and tit.transfer_date<='".$too_date."' order by tit.transfer_date ASC";  
             }
           }else if(!empty($f_date)){
              if(!empty($where)){ 
                $sql="select tit.*,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from tbl_item_transfer tit  left join department d on tit.from_unit_id=d.d_id left join items i on tit.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where and tit.transfer_date>='".$from_date."' and tit.transfer_date<='".$too_date."' order by tit.transfer_date ASC";  
              }else{
                $sql="select tit.*,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from tbl_item_transfer tit  left join department d on tit.from_unit_id=d.d_id left join items i on tit.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where tit.transfer_date>='".$from_date."' and tit.transfer_date<='".$too_date."' order by tit.transfer_date ASC";    
              }
           }else if(!empty($to_date)){
              if(!empty($where)){ 
                $sql="select tit.*,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from tbl_item_transfer tit  left join department d on tit.from_unit_id=d.d_id left join items i on tit.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where and tit.transfer_date>='".$from_date."' and tit.transfer_date<='".$too_date."' order by tit.transfer_date ASC";   
              }else{
                $sql="select tit.*,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from tbl_item_transfer tit  left join department d on tit.from_unit_id=d.d_id left join items i on tit.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where tit.transfer_date>='".$from_date."' and tit.transfer_date<='".$too_date."' order by tit.transfer_date ASC";     
              }
           }else{
              if(!empty($where)){
                $sql="select tit.*,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from tbl_item_transfer tit  left join department d on tit.from_unit_id=d.d_id left join items i on tit.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id where $where order by tit.transfer_date ASC";
              }else{
                $sql="select tit.*,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from tbl_item_transfer tit  left join department d on tit.from_unit_id=d.d_id left join items i on tit.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id order by tit.transfer_date ASC";  
              }
           }
           
           
           $data['purchase_orders']=$this->m_common->customeQuery($sql);
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $data['products']=$this->m_common->get_row_array('items','','*');
           $this->load->view('report/materialtransfer_report',$data);      
              
        }else{
          
           
           $data['products']=$this->m_common->get_row_array('items','','*');
           $sql="select tit.*,d.dep_description,i.item_name,tmu.meas_unit,tsu.unit_name from tbl_item_transfer tit  left join department d on tit.from_unit_id=d.d_id left join items i on tit.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_size_unit tsu on i.size_unit_id=tsu.size_unit_id order by tit.transfer_date ASC";
           $data['purchase_orders']=$this->m_common->customeQuery($sql); 
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $this->load->view('report/materialtransfer_report',$data);                
        }
        
    }
    function materialTransferValue($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $item=$this->input->post('item');
           $data['f_date']=$f_date;
           $data['to_date']=$to_date; 
           $data['item_id']=$item;
           $data['item_check']=$item;
           $data['projects']=$this->m_common->get_row_array('department','','*');
    
                
               
           
             
        }else{
          
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $this->load->view('report/materialtransfervalue_report',$data);
         
       
        }
        
    }
    function serviceAverageRate($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $item=$this->input->post('item');
           $data['f_date']=$f_date;
           $data['to_date']=$to_date; 
           $data['item_id']=$item;
           $data['item_check']=$item;
           $data['projects']=$this->m_common->get_row_array('department','','*');
    
                
               
           
             
        }else{
          
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $data['products']=$this->m_common->get_row_array('items','','*');
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $sql="select pod.*,sum(pod.quantity) as total_qty,sum(pod.amount) as total,d.dep_description,i.item_name,tmu.meas_unit from tbl_purchase_order_details pod left join tbl_purchase_orders po on po.o_id=pod.o_id left join department d on po.unit_id=d.d_id left join ipo_material_indent_details imid on pod.indent_d_id=imid.id left join items i on pod.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id left join tbl_indent_type tit on po.order_type=tit.id where po.approve_status='Approved' group by pod.item_id";
           $data['purchase_orders']=$this->m_common->customeQuery($sql);
           $this->load->view('report/serviceaveragerate_report',$data);
         
       
        }
        
    }
    
    function storeLedger($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $branch_id= $this->session->userdata('companyId');
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $data['report_format']=$report_format;
           $item=$this->input->post('item');
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $from_date=date('Y-m-d',strtotime($f_date));
           $too_date=date('Y-m-d',strtotime($to_date));
           $data['item_id']=$item;
           $data['item_check']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           
           
           if($item!='all'){
                $item_info=$this->m_common->get_row_array('items',array('id'=>$item),'*');
                $brands= $this->m_common->get_row_array('tbl_item_brand',array('is_active'=>1), '*');
                $item_brands=  unserialize($item_info[0]['brand_id']);
                $b=array();
                foreach($brands as $key1=>$brand){
                        if(!empty($item_brands)){  
                            if(in_array($brand['id'],$item_brands)){
                              $b[]=$brand;
                            }else{
                                 unset($brands[$key1]);
                            }
                        }else{
                            $b='';
                        }
                }        
                $data['brands']=$b;
           }else{
               $data['brands']='';
           }
           
           
           $brand_id=$this->input->post('brand_id');
           
           
           if($report_format=='general'){
                    $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                    if($item=="all"){
                       $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                    }else{
                        $data['items']=$this->m_common->get_row_array('items',array('id'=>$item),'*'); 
                    }
           }else{
               //$data['groups']=$this->m_common->get_row_array('item_groups','','*');
                $data['groups']=$this->m_common->get_row_array('item_groups',array('group_type'=>"Consumable"),'*');
                   
               //$data['items']=$this->m_common->get_row_array('items',array('item_group'=>$item),'*','','','item_name'); 
               if($item=='all'){
                   $data['group']=$this->m_common->get_row_array('item_groups',array('group_type'=>"Consumable"),'*');
                   foreach($data['group'] as $key=>$group){
                     $data['group'][$key]['group_items']=$this->m_common->get_row_array('items',array('item_group'=>$group['id']),'*','','','item_name');  
                   }
               }else{
                   $data['items']=$this->m_common->get_row_array('items',array('item_group'=>$item),'*','','','item_name'); 
                   $data['group_info']=$this->m_common->get_row_array('item_groups',array('id'=>$item),'*'); 
               }
                    
               
           }
           if(($report_format=='general' && $item=="all") || $report_format=='group' ){
                if($item=="all" && $report_format=='group' ){
                    foreach($data['group'] as $key1=>$gr){
                
                            foreach($data['group'][$key1]['group_items'] as $key=>$item_info){
                               //This part is for opening calculation
                               $opening_from_date="2021-01-01";
                               $opening_to_date=date('Y-m-d', strtotime('-1 day', strtotime($from_date)));
                            //   $opeing_info=$this->m_common->get_row_array('tbl_item_opening_stock',array('item_id'=>$item,'unit_id'=>$branch_id),'*');
                               
                               
                               $opeing_info=array();
                               $ope_sql="select sum(opening_stock) as total_opening_stock,sum(opening_amount) as total_opening_value from tbl_item_opening_stock where item_id=".$item_info['id'] ." and unit_id=$branch_id";
                               $opeing_info=$this->m_common->customeQuery($ope_sql);
                               
                               $adjustment_qty=array();
                               $sql='Select sum(qty) as adjust_qty,sum(amount) as adjust_value from tbl_item_adjustment where date<"'.$opening_to_date.'" and item_id='.$item_info['id'].' and is_active=1 and status="Confirmed" and unit_id='.$branch_id;
                               $adjustment_qty=$this->m_common->customeQuery($sql);
                               

                               $receive_qty=array();
                               $sql='Select sum(tmrrd.receive_qty) as re_qty,sum(tmrrd.amount) as re_value from tbl_material_receive_requisition_details tmrrd left join material_receive_requisition mrr on tmrrd.mrr_id=mrr.mrr_id  where tmrrd.receive_date>="'.$opening_from_date.'" and tmrrd.receive_date<="'.$opening_to_date.'" and tmrrd.item_id='.$item_info['id'].' and mrr.mrr_status="received" and mrr.unit_id='.$branch_id;
                               $receive_qty=$this->m_common->customeQuery($sql);
                               
                               $issue_return_qty=array();
                               $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date>="'.$opening_from_date.'" and ir_date<="'.$opening_to_date.'" and item_id='.$item_info['id'].' and ir_d_status="received" ';
                               $issue_return_qty=$this->m_common->customeQuery($sql);

                               $mrr_return_receive=array();
                               $sql='Select sum(mrrd.receive_qty) as mrr_receive_qty,sum(mrrd.receive_value) as mrr_receive_value from mrr_return_receive_details mrrd left join mrr_return_receive mrr on mrrd.mrr_rr_id=mrr.mrr_rr_id where mrrd.receive_date>="'.$opening_from_date.'" and mrrd.receive_date<="'.$opening_to_date.'" and mrrd.item_id='.$item_info['id'].' and mrrd.mrr_rr_d_status="received" and mrr.branch_id='.$branch_id;
                               $mrr_return_receive=$this->m_common->customeQuery($sql);

                               $total_receive_qty=$receive_qty[0]['re_qty']+$issue_return_qty[0]['is_ret_qty']+$mrr_return_receive[0]['mrr_receive_qty']+$adjustment_qty[0]['adjust_qty'];
                               $total_receive_value=$receive_qty[0]['re_value']+$issue_return_qty[0]['is_ret_value']+$mrr_return_receive[0]['mrr_receive_value']+$adjustment_qty[0]['adjust_value'];
                               
                               $issue_qty=array();
                               $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$opening_from_date.'" and consumption_date<="'.$opening_to_date.'" and item_id='.$item_info['id'].' and status="Approved" and unit_id='.$branch_id;
                               $issue_qty=$this->m_common->customeQuery($sql);

                               
                               $delivery_issue_qty=array();
                               $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where issue_date>="'.$opening_from_date.'" and issue_date<="'.$opening_to_date.'" and item_id='.$item_info['id'].' and issue_status="issued" and issue_type="delivey" ';
                               $delivery_issue_qty=$this->m_common->customeQuery($sql);

                               
                               $return_qty=array();
                               $sql='Select sum(rrd.return_qty) as ret_qty,sum(rrd.return_value) as ret_value from return_receive_details rrd left join return_receive rr on rrd.rr_id=rr.rr_id where rrd.rr_date>="'.$opening_from_date.'" and rrd.rr_date<="'.$opening_to_date.'" and rrd.item_id='.$item_info['id'].' and rrd.rr_d_status="returned" and rr.branch_id='.$branch_id;
                               $return_qty=$this->m_common->customeQuery($sql);

                               $total_issue_qty=$issue_qty[0]['issue_qty']+$delivery_issue_qty[0]['issue_qty']+$return_qty[0]['ret_qty'];
                               $total_issue_value=$issue_qty[0]['issue_value']+$delivery_issue_qty[0]['issue_value']+$return_qty[0]['ret_value'];

                               $opening_qty=$total_receive_qty+$opeing_info[0]['total_opening_stock']-$total_issue_qty;
                               $opening_value=$total_receive_value+$opeing_info[0]['total_opening_value']-$total_issue_value;
                               $current_rate=round($opening_value/$opening_qty,2);
                               if(!empty($opening_qty)){
                                   $data['group'][$key1]['group_items'][$key]['opening_balance']=$opening_qty;
                               }else{
                                  $data['group'][$key1]['group_items'][$key]['opening_balance']='-'; 
                               }
                               if(!empty($opening_value)){
                                   $data['group'][$key1]['group_items'][$key]['opening_value']=$opening_value;
                               }else{
                                  $data['group'][$key1]['group_items'][$key]['opening_value']='-'; 
                               }
                               if(!empty($current_rate)){
                                    $data['group'][$key1]['group_items'][$key]['opening_rate']=$current_rate;
                               }else{
                                   $data['group'][$key1]['group_items'][$key]['opening_rate']='-'; 
                               }




                               //End Opening Calculation 


                                $receive_qty=array();
                                $sql='Select sum(tmrrd.receive_qty) as re_qty,sum(tmrrd.amount) as re_value from tbl_material_receive_requisition_details tmrrd left join material_receive_requisition mrr on tmrrd.mrr_id=mrr.mrr_id where tmrrd.receive_date>="'.$from_date.'" and tmrrd.receive_date<="'.$too_date.'" and tmrrd.item_id='.$item_info['id'].' and mrr.mrr_status="received" and mrr.unit_id='.$branch_id;
                                $receive_qty=$this->m_common->customeQuery($sql);
                                if(!empty($receive_qty[0]['re_qty'])){
                                      $data['group'][$key1]['group_items'][$key]['receive_qty']=$receive_qty[0]['re_qty'];
                                      $data['group'][$key1]['group_items'][$key]['receive_value']=$receive_qty[0]['re_value'];
                                      $data['group'][$key1]['group_items'][$key]['receive_rate']=round($receive_qty[0]['re_value']/$receive_qty[0]['re_qty'],2);
                                }else{
                                     $data['group'][$key1]['group_items'][$key]['receive_qty']='-'; 
                                     $data['group'][$key1]['group_items'][$key]['receive_value']='-';
                                     $data['group'][$key1]['group_items'][$key]['receive_rate']='-';
                                }

                                
                                $issue_return_qty=array();
                                $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date>="'.$from_date.'" and ir_date<="'.$too_date.'" and item_id='.$item_info['id'].' and ir_d_status="received" ';
                                $issue_return_qty=$this->m_common->customeQuery($sql);
                                if(!empty($issue_return_qty[0]['is_ret_qty'])){
                                      $data['group'][$key1]['group_items'][$key]['issue_return_qty']=$issue_return_qty[0]['is_ret_qty'];
                                      $data['group'][$key1]['group_items'][$key]['issue_return_value']=$issue_return_qty[0]['is_ret_value'];
                                      $data['group'][$key1]['group_items'][$key]['issue_return_rate']=$issue_return_qty[0]['is_ret_value']/$issue_return_qty[0]['is_ret_qty'];
                                }else{
                                     $data['group'][$key1]['group_items'][$key]['issue_return_qty']='-';
                                     $data['group'][$key1]['group_items'][$key]['issue_return_value']='-';
                                     $data['group'][$key1]['group_items'][$key]['issue_return_rate']='-';
                                }

                                //this part is for replacement from party
                                $mrr_return_receive=array();
                                $sql='Select sum(mrrd.receive_qty) as mrr_receive_qty,sum(mrrd.receive_value) as mrr_receive_value from mrr_return_receive_details mrrd left join mrr_return_receive mrr on mrrd.mrr_rr_id=mrr.mrr_rr_id where mrrd.receive_date>="'.$from_date.'" and mrrd.receive_date<="'.$too_date.'" and mrrd.item_id='.$item_info['id'].' and mrrd.mrr_rr_d_status="received" and mrr.branch_id='.$branch_id;
                                $mrr_return_receive=$this->m_common->customeQuery($sql);
                                if(!empty($mrr_return_receive[0]['mrr_receive_qty'])){
                                     $data['group'][$key1]['group_items'][$key]['mrr_receive_qty']=$mrr_return_receive[0]['mrr_receive_qty'];
                                     $data['group'][$key1]['group_items'][$key]['mrr_receive_value']=$mrr_return_receive[0]['mrr_receive_value'];
                                     $data['group'][$key1]['group_items'][$key]['mrr_receive_rate']=$mrr_return_receive[0]['mrr_receive_value']/$mrr_return_receive[0]['mrr_receive_qty'];
                                }else{
                                     $data['group'][$key1]['group_items'][$key]['mrr_receive_qty']='-';
                                     $data['group'][$key1]['group_items'][$key]['mrr_receive_value']='-';
                                     $data['group'][$key1]['group_items'][$key]['mrr_receive_rate']='-';
                                }
                                
                                
                                //this part is for Low or Access Adjustment 
                                $adjustment_qty=array();
                                $sql='Select sum(qty) as adjust_qty,sum(amount) as adjust_value from tbl_item_adjustment where date>="'.$from_date.'" and date<="'.$too_date.'" and item_id='.$item_info['id'].' and is_active=1 and status="Confirmed" and unit_id='.$branch_id;
                                $adjustment_qty=$this->m_common->customeQuery($sql);
                                if(!empty($adjustment_qty[0]['adjust_qty'])){
                                     $data['group'][$key1]['group_items'][$key]['adjust_qty']=$adjustment_qty[0]['adjust_qty'];
                                     $data['group'][$key1]['group_items'][$key]['adjust_value']=$adjustment_qty[0]['adjust_value'];
                                     $data['group'][$key1]['group_items'][$key]['adjust_rate']=$adjustment_qty[0]['adjust_value']/$adjustment_qty[0]['adjust_qty'];
                                }else{
                                     $data['group'][$key1]['group_items'][$key]['adjust_qty']='-';
                                     $data['group'][$key1]['group_items'][$key]['adjust_value']='-';
                                     $data['group'][$key1]['group_items'][$key]['adjust_rate']='-';
                                }
                                

                //                $data['items'][$key]['return_receive_qty']=$data['items'][$key]['issue_return_qty']+$data['items'][$key]['mrr_receive_qty'];
                //                $data['items'][$key]['return_receive_value']= $data['items'][$key]['issue_return_value']+$data['items'][$key]['mrr_receive_value'];



                                $avilable_quantity= $data['group'][$key1]['group_items'][$key]['receive_qty']+$data['group'][$key1]['group_items'][$key]['issue_return_qty']+$data['group'][$key1]['group_items'][$key]['mrr_receive_qty']+$data['group'][$key1]['group_items'][$key]['adjust_qty']+$opening_qty;
                                $avilable_value= $data['group'][$key1]['group_items'][$key]['receive_value']+$data['group'][$key1]['group_items'][$key]['issue_return_value']+$data['group'][$key1]['group_items'][$key]['mrr_receive_value']+$data['group'][$key1]['group_items'][$key]['adjust_value']+$opening_value;
                                $available_rate=round($avilable_value/$avilable_quantity,2);
            //                    $data['items'][$key]['total_rec_ret_qty']=$data['items'][$key]['receive_qty']+$data['items'][$key]['issue_return_qty']+$data['items'][$key]['mrr_receive_qty'];
            //                    $data['items'][$key]['total_rec_ret_value']=$data['items'][$key]['receive_value']+ $data['items'][$key]['issue_return_value']+$data['items'][$key]['mrr_receive_value'];
            //                    $data['items'][$key]['total_rec_ret_rate']=round($avilable_value/$avilable_quantity,2);
                               if(!empty($avilable_quantity)){
                                    $data['group'][$key1]['group_items'][$key]['total_rec_ret_qty']=$avilable_quantity;
                               }else{
                                   $data['group'][$key1]['group_items'][$key]['total_rec_ret_qty']='-'; 
                               }
                               if(!empty($avilable_value)){
                                   $data['group'][$key1]['group_items'][$key]['total_rec_ret_value']=$avilable_value;
                               }else{
                                   $data['group'][$key1]['group_items'][$key]['total_rec_ret_value']='-'; 
                               }
                               if(!empty($available_rate)){
                                     $data['group'][$key1]['group_items'][$key]['total_rec_ret_rate']=$available_rate;
                               }else{
                                   $data['group'][$key1]['group_items'][$key]['total_rec_ret_rate']='-'; 
                               }

                             //This part is for general issue
                                $issue_qty=array();
                                $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$from_date.'" and consumption_date<="'.$too_date.'" and item_id='.$item_info['id'].' and status="Approved" and unit_id='.$branch_id;
                                $issue_qty=$this->m_common->customeQuery($sql);
                                if(!empty($issue_qty[0]['issue_qty'])){
                                       $data['group'][$key1]['group_items'][$key]['issue_qty']=$issue_qty[0]['issue_qty'];
                                       $data['group'][$key1]['group_items'][$key]['issue_value']=$issue_qty[0]['issue_value'];
                                       $data['group'][$key1]['group_items'][$key]['issue_rate']=$issue_qty[0]['issue_value']/$issue_qty[0]['issue_qty'];
                                }else{
                                      $data['group'][$key1]['group_items'][$key]['issue_qty']='-'; 
                                      $data['group'][$key1]['group_items'][$key]['issue_value']='-';
                                      $data['group'][$key1]['group_items'][$key]['issue_rate']='-';
                                }

                               //This part is for delivery issue 
                                $d_issue_qty=array();
                                $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where issue_date>="'.$from_date.'" and issue_date<="'.$too_date.'" and item_id='.$item_info['id'].' and issue_status="issued" and issue_type="delivey" ';
                                $d_issue_qty=$this->m_common->customeQuery($sql);
                                if(!empty($d_issue_qty[0]['delivery_qty'])){
                                      $data['group'][$key1]['group_items'][$key]['delivery_qty']=$d_issue_qty[0]['issue_qty'];
                                      $data['group'][$key1]['group_items'][$key]['delivery_value']=$d_issue_qty[0]['issue_value'];
                                      $data['group'][$key1]['group_items'][$key]['delivery_rate']=$d_issue_qty[0]['issue_value']/$d_issue_qty[0]['issue_qty'];
                                }else{
                                     $data['group'][$key1]['group_items'][$key]['delivery_qty']='-'; 
                                     $data['group'][$key1]['group_items'][$key]['delivery_value']='-';
                                     $data['group'][$key1]['group_items'][$key]['delivery_rate']='-';
                                }


                                //This part is for return to party info
                                $return_qty=array();
                                $sql='Select sum(rrd.return_qty) as ret_qty,sum(rrd.return_value) as ret_value from return_receive_details rrd left join return_receive rr on rrd.rr_id=rr.rr_id where rrd.rr_date>="'.$from_date.'" and rrd.rr_date<="'.$too_date.'" and rrd.item_id='.$item_info['id'].' and rrd.rr_d_status="returned" and rr.branch_id='.$branch_id;
                                $return_qty=$this->m_common->customeQuery($sql);
                                if(!empty($return_qty[0]['ret_qty'])){
                                     $data['group'][$key1]['group_items'][$key]['return_qty']=$return_qty[0]['ret_qty'];
                                     $data['group'][$key1]['group_items'][$key]['return_value']=$return_qty[0]['ret_value'];
                                     $gr['group_items'][$key]['return_rate']=$return_qty[0]['ret_value']/$return_qty[0]['ret_qty'];
                                }else{
                                    $data['group'][$key1]['group_items'][$key]['return_qty']='-'; 
                                    $data['group'][$key1]['group_items'][$key]['return_value']='-';
                                    $data['group'][$key1]['group_items'][$key]['return_rate']='-';
                                }







                                $total_issue_qty=$data['group'][$key1]['group_items'][$key]['issue_qty']+$data['group'][$key1]['group_items'][$key]['return_qty']+ $data['group'][$key1]['group_items'][$key]['delivery_qty']; 
                                $total_issue_value=$data['group'][$key1]['group_items'][$key]['issue_value']+$data['group'][$key1]['group_items'][$key]['return_value']+$data['group'][$key1]['group_items'][$key]['delivery_value'];
                                $total_issue_rate=$total_issue_value/$total_issue_qty;
            //                    $data['items'][$key]['total_issue_qty']=$total_issue_qty; 
            //                    $data['items'][$key]['total_issue_value']= $total_issue_value;
            //                    $data['items'][$key]['total_issue_rate']= $total_issue_value/$total_issue_qty;
                               if(!empty($total_issue_qty)){
                                    $data['group'][$key1]['group_items'][$key]['total_issue_qty']=$total_issue_qty;
                               }else{
                                   $data['group'][$key1]['group_items'][$key]['total_issue_qty']='-'; 
                               }
                               if(!empty($total_issue_value)){
                                   $data['group'][$key1]['group_items'][$key]['total_issue_value']=$total_issue_value;
                               }else{
                                   $data['group'][$key1]['group_items'][$key]['total_issue_value']='-'; 
                               }
                               if(!empty($total_issue_rate)){
                                   $data['group'][$key1]['group_items'][$key]['total_issue_rate']=$total_issue_rate;
                               }else{
                                   $data['group'][$key1]['group_items'][$key]['total_issue_rate']='-'; 
                               }

                                $balance=$avilable_quantity-$total_issue_qty; 
                                $balance_value=$avilable_value-$total_issue_value; 
                                $balance_rate=round($balance_value/$balance,2); 
            //                    $data['items'][$key]['closing_balance']=$avilable_quantity-$total_issue_qty; 
            //                    $data['items'][$key]['closing_value']=$avilable_value-$total_issue_value;
            //                    $data['items'][$key]['closing_rate']=round($balance_value/$balance,2); 
                               if(!empty($balance)){
                                   $data['group'][$key1]['group_items'][$key]['closing_balance']=$balance;
                               }else{
                                  $data['group'][$key1]['group_items'][$key]['closing_balance']='-'; 
                               }
                               if(!empty($balance_value)){
                                   $data['group'][$key1]['group_items'][$key]['closing_value']=$balance_value;
                               }else{
                                   $data['group'][$key1]['group_items'][$key]['closing_value']='-'; 
                               }
                               if(!empty($balance_rate)){
                                   $data['group'][$key1]['group_items'][$key]['closing_rate']=$balance_rate;
                               }else{
                                   $data['group'][$key1]['group_items'][$key]['closing_rate']='-'; 
                               }


            //                    if(empty( $data['items'][$key]['opening_balance']) && empty( $data['items'][$key]['receive_qty']) && empty( $data['items'][$key]['issue_return_qty']) && empty( $data['items'][$key]['mrr_receive_qty']) && empty( $data['items'][$key]['issue_qty']) && empty( $data['items'][$key]['delivery_qty']) && empty( $data['items'][$key]['return_qty']) && empty( $data['items'][$key]['total_issue_qty']) && empty( $data['items'][$key]['closing_balance']) ){
            //                        unset( $data['items'][$key]);
            //                    }

                                if($data['group'][$key1]['group_items'][$key]['opening_balance']=='-' && $data['group'][$key1]['group_items'][$key]['receive_qty']=='-' && $data['group'][$key1]['group_items'][$key]['issue_return_qty']=='-' && $data['group'][$key1]['group_items'][$key]['mrr_receive_qty']=='-' && $data['group'][$key1]['group_items'][$key]['issue_qty']=='-' && $data['group'][$key1]['group_items'][$key]['delivery_qty']=='-' && $data['group'][$key1]['group_items'][$key]['return_qty']=='-' && $data['group'][$key1]['group_items'][$key]['total_issue_qty']=='-' && $data['group'][$key1]['group_items'][$key]['closing_balance']=='-'){
                                   unset($data['group'][$key1]['group_items'][$key]); 
                                }

                          } //End Innder foreach           

                    } //End foreach
//                    echo '<pre>';
//                    print_r($data['group']);
//                    echo '</pre>';
//                    exit;
                }else{
                           foreach($data['items'] as $key=>$item_info){


                           //This part is for opening calculation
                           $opening_from_date="2021-01-01";
                           $opening_to_date=date('Y-m-d', strtotime('-1 day', strtotime($from_date)));
                           //$opeing_info=$this->m_common->get_row_array('tbl_item_opening_stock',array('item_id'=>$item_info['id'],'unit_id'=>$branch_id),'*');
                           $opeing_info=array();
                           $ope_sql="select sum(opening_stock) as total_opening_stock,sum(opening_amount) as total_opening_value from tbl_item_opening_stock where item_id=".$item_info['id']." and unit_id=$branch_id";
                           $opeing_info=$this->m_common->customeQuery($ope_sql);
                           
                           
                           $adjustment_qty=array();
                           $sql='Select sum(qty) as adjust_qty,sum(amount) as adjust_value from tbl_item_adjustment where date<"'.$opening_to_date.'" and item_id='.$item_info['id'].' and is_active=1 and status="Confirmed" and unit_id='.$branch_id;
                           $adjustment_qty=$this->m_common->customeQuery($sql);
                           
                           
                           $receive_qty=array();

                           $sql='Select sum(tmrrd.receive_qty) as re_qty,sum(tmrrd.amount) as re_value from tbl_material_receive_requisition_details tmrrd left join material_receive_requisition mrr on tmrrd.mrr_id=mrr.mrr_id  where tmrrd.receive_date>="'.$opening_from_date.'" and tmrrd.receive_date<="'.$opening_to_date.'" and tmrrd.item_id='.$item_info['id'].' and mrr.mrr_status="received" and mrr.unit_id='.$branch_id;
                           $receive_qty=$this->m_common->customeQuery($sql);

                           $issue_return_qty=array();
                           $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date>="'.$opening_from_date.'" and ir_date<="'.$opening_to_date.'" and item_id='.$item_info['id'].' and ir_d_status="received" ';
                           $issue_return_qty=$this->m_common->customeQuery($sql);

                           $mrr_return_receive=array();
                           $sql='Select sum(mrrd.receive_qty) as mrr_receive_qty,sum(mrrd.receive_value) as mrr_receive_value from mrr_return_receive_details mrrd left join mrr_return_receive mrr on mrrd.mrr_rr_id=mrr.mrr_rr_id where mrrd.receive_date>="'.$opening_from_date.'" and mrrd.receive_date<="'.$opening_to_date.'" and mrrd.item_id='.$item_info['id'].' and mrrd.mrr_rr_d_status="received" ';
                           $mrr_return_receive=$this->m_common->customeQuery($sql);

                           $total_receive_qty=$receive_qty[0]['re_qty']+$issue_return_qty[0]['is_ret_qty']+$mrr_return_receive[0]['mrr_receive_qty']+$adjustment_qty[0]['adjust_qty'];
                           $total_receive_value=$receive_qty[0]['re_value']+$issue_return_qty[0]['is_ret_value']+$mrr_return_receive[0]['mrr_receive_value']+$adjustment_qty[0]['adjust_value'];

                          
                          $issue_qty=array();  
                          $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$opening_from_date.'" and consumption_date<="'.$opening_to_date.'" and item_id='.$item_info['id'].' and status="Approved" and unit_id='.$branch_id;
                          $issue_qty=$this->m_common->customeQuery($sql);

                          $delivery_issue_qty=array();
                          $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where issue_date>="'.$opening_from_date.'" and issue_date<="'.$opening_to_date.'" and item_id='.$item_info['id'].' and issue_status="issued" and issue_type="delivey" ';
                          $delivery_issue_qty=$this->m_common->customeQuery($sql);
                          
                          $return_qty=array();  
                          $sql='Select sum(rrd.return_qty) as ret_qty,sum(rrd.return_value) as ret_value from return_receive_details rrd left join return_receive rr on rrd.rr_id=rr.rr_id where rrd.rr_date>="'.$opening_from_date.'" and rrd.rr_date<="'.$opening_to_date.'" and rrd.item_id='.$item_info['id'].' and rrd.rr_d_status="returned" and rr.branch_id='.$branch_id;
                          $return_qty=$this->m_common->customeQuery($sql);

                          $total_issue_qty=$issue_qty[0]['issue_qty']+$delivery_issue_qty[0]['issue_qty']+$return_qty[0]['ret_qty'];
                          $total_issue_value=$issue_qty[0]['issue_value']+$delivery_issue_qty[0]['issue_value']+$return_qty[0]['ret_value'];

                          $opening_qty=$total_receive_qty+$opeing_info[0]['total_opening_stock']-$total_issue_qty;
                          $opening_value=$total_receive_value+$opeing_info[0]['total_opening_value']-$total_issue_value;
                          $current_rate=round($opening_value/$opening_qty,2);

                          if(!empty($opening_qty)){
                               $data['items'][$key]['opening_balance']=$opening_qty;
                          }else{
                             $data['items'][$key]['opening_balance']='-'; 
                          }
                          if(!empty($opening_value)){
                               $data['items'][$key]['opening_value']=$opening_value;
                          }else{
                             $data['items'][$key]['opening_value']='-'; 
                          }
                          if(!empty($current_rate)){
                               $data['items'][$key]['opening_rate']=$current_rate;
                          }else{
                             $data['items'][$key]['opening_rate']='-'; 
                          }




                          //End Opening Calculation 


                           $receive_qty=array();
                           $sql='Select sum(tmrrd.receive_qty) as re_qty,sum(tmrrd.amount) as re_value from tbl_material_receive_requisition_details tmrrd left join material_receive_requisition mrr on tmrrd.mrr_id=mrr.mrr_id where tmrrd.receive_date>="'.$from_date.'" and tmrrd.receive_date<="'.$too_date.'" and tmrrd.item_id='.$item_info['id'].' and mrr.mrr_status="received" and mrr.unit_id='.$branch_id;
                           $receive_qty=$this->m_common->customeQuery($sql);
                           if(!empty($receive_qty[0]['re_qty'])){
                                $data['items'][$key]['receive_qty']=$receive_qty[0]['re_qty'];
                                $data['items'][$key]['receive_value']=$receive_qty[0]['re_value'];
                                $data['items'][$key]['receive_rate']=round($receive_qty[0]['re_value']/$receive_qty[0]['re_qty'],2);
                           }else{
                               $data['items'][$key]['receive_qty']='-'; 
                               $data['items'][$key]['receive_value']='-';
                               $data['items'][$key]['receive_rate']='-';
                           }


                           $issue_return_qty=array();
                           $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date>="'.$from_date.'" and ir_date<="'.$too_date.'" and item_id='.$item_info['id'].' and ir_d_status="received" ';
                           $issue_return_qty=$this->m_common->customeQuery($sql);
                           if(!empty($issue_return_qty[0]['is_ret_qty'])){
                                $data['items'][$key]['issue_return_qty']=$issue_return_qty[0]['is_ret_qty'];
                                $data['items'][$key]['issue_return_value']=$issue_return_qty[0]['is_ret_value'];
                                $data['items'][$key]['issue_return_rate']=round($issue_return_qty[0]['is_ret_value']/$issue_return_qty[0]['is_ret_qty'],2);
                           }else{
                               $data['items'][$key]['issue_return_qty']='-';
                               $data['items'][$key]['issue_return_value']='-';
                               $data['items'][$key]['issue_return_rate']='-';
                           }

                           //this part is for replacement from party
                           $mrr_return_receive=array();
                           $sql='Select sum(mrrd.receive_qty) as mrr_receive_qty,sum(mrrd.receive_value) as mrr_receive_value from mrr_return_receive_details mrrd left join mrr_return_receive mrr on mrrd.mrr_rr_id=mrr.mrr_rr_id where mrrd.receive_date>="'.$from_date.'" and mrrd.receive_date<="'.$too_date.'" and mrrd.item_id='.$item_info['id'].' and mrrd.mrr_rr_d_status="received" and mrr.branch_id='.$branch_id;
                           $mrr_return_receive=$this->m_common->customeQuery($sql);
                           if(!empty($mrr_return_receive[0]['mrr_receive_qty'])){
                                $data['items'][$key]['mrr_receive_qty']=$mrr_return_receive[0]['mrr_receive_qty'];
                                $data['items'][$key]['mrr_receive_value']=$mrr_return_receive[0]['mrr_receive_value'];
                                $data['items'][$key]['mrr_receive_rate']=round($mrr_return_receive[0]['mrr_receive_value']/$mrr_return_receive[0]['mrr_receive_qty'],2);
                           }else{
                               $data['items'][$key]['mrr_receive_qty']='-';
                               $data['items'][$key]['mrr_receive_value']='-';
                               $data['items'][$key]['mrr_receive_rate']='-';
                           }

           //                $data['items'][$key]['return_receive_qty']=$data['items'][$key]['issue_return_qty']+$data['items'][$key]['mrr_receive_qty'];
           //                $data['items'][$key]['return_receive_value']= $data['items'][$key]['issue_return_value']+$data['items'][$key]['mrr_receive_value'];

                           
                           
                            //this part is for Low or Access Adjustment 
                           
                            $adjustment_qty=array();
                            $sql='Select sum(qty) as adjust_qty,sum(amount) as adjust_value from tbl_item_adjustment where date>="'.$from_date.'" and date<="'.$too_date.'" and item_id='.$item_info['id'].' and is_active=1 and status="Confirmed" and unit_id='.$branch_id;
                            $adjustment_qty=$this->m_common->customeQuery($sql);
                            if(!empty($adjustment_qty[0]['adjust_qty'])){
                                 $data['items'][$key]['adjust_qty']=$adjustment_qty[0]['adjust_qty'];
                                 $data['items'][$key]['adjust_value']=$adjustment_qty[0]['adjust_value'];
                                 $data['items'][$key]['adjust_rate']=$adjustment_qty[0]['adjust_value']/$adjustment_qty[0]['adjust_qty'];
                            }else{
                                 $data['items'][$key]['adjust_qty']='-';
                                 $data['items'][$key]['adjust_value']='-';
                                 $data['items'][$key]['adjust_rate']='-';
                            }
                           
                           
                           


                           $avilable_quantity=$data['items'][$key]['receive_qty']+$data['items'][$key]['issue_return_qty']+$data['items'][$key]['mrr_receive_qty']+$data['items'][$key]['adjust_qty']+$opening_qty;
                           $avilable_value=$data['items'][$key]['receive_value']+ $data['items'][$key]['issue_return_value']+$data['items'][$key]['mrr_receive_value']+$data['items'][$key]['adjust_value']+$opening_value;
                           $available_rate=round($avilable_value/$avilable_quantity,2);
       //                    $data['items'][$key]['total_rec_ret_qty']=$data['items'][$key]['receive_qty']+$data['items'][$key]['issue_return_qty']+$data['items'][$key]['mrr_receive_qty'];
       //                    $data['items'][$key]['total_rec_ret_value']=$data['items'][$key]['receive_value']+ $data['items'][$key]['issue_return_value']+$data['items'][$key]['mrr_receive_value'];
       //                    $data['items'][$key]['total_rec_ret_rate']=round($avilable_value/$avilable_quantity,2);
                          if(!empty($avilable_quantity)){
                               $data['items'][$key]['total_rec_ret_qty']=$avilable_quantity;
                          }else{
                             $data['items'][$key]['total_rec_ret_qty']='-'; 
                          }
                          if(!empty($avilable_value)){
                               $data['items'][$key]['total_rec_ret_value']=$avilable_value;
                          }else{
                             $data['items'][$key]['total_rec_ret_value']='-'; 
                          }
                          if(!empty($available_rate)){
                               $data['items'][$key]['total_rec_ret_rate']=$available_rate;
                          }else{
                             $data['items'][$key]['total_rec_ret_rate']='-'; 
                          }

                        //This part is for general issue
                           $issue_qty=array();
                           $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$from_date.'" and consumption_date<="'.$too_date.'" and item_id='.$item_info['id'].' and status="Approved" and unit_id='.$branch_id;
                           $issue_qty=$this->m_common->customeQuery($sql);
                           if(!empty($issue_qty[0]['issue_qty'])){
                                $data['items'][$key]['issue_qty']=$issue_qty[0]['issue_qty'];
                                $data['items'][$key]['issue_value']=$issue_qty[0]['issue_value'];
                                $data['items'][$key]['issue_rate']=round($issue_qty[0]['issue_value']/$issue_qty[0]['issue_qty'],2);
                           }else{
                               $data['items'][$key]['issue_qty']='-'; 
                               $data['items'][$key]['issue_value']='-';
                               $data['items'][$key]['issue_rate']='-';
                           }

                          //This part is for delivery issue 
                           $d_issue_qty=array();
                           $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where issue_date>="'.$from_date.'" and issue_date<="'.$too_date.'" and item_id='.$item_info['id'].' and issue_status="issued" and issue_type="delivey" ';
                           $d_issue_qty=$this->m_common->customeQuery($sql);
                           if(!empty($issue_qty[0]['delivery_qty'])){
                                $data['items'][$key]['delivery_qty']=$d_issue_qty[0]['issue_qty'];
                                $data['items'][$key]['delivery_value']=$d_issue_qty[0]['issue_value'];
                                $data['items'][$key]['delivery_rate']=round($d_issue_qty[0]['issue_value']/$d_issue_qty[0]['issue_qty']);
                           }else{
                               $data['items'][$key]['delivery_qty']='-'; 
                               $data['items'][$key]['delivery_value']='-';
                               $data['items'][$key]['delivery_rate']='-';
                           }


                           //This part is for return to party info
                           $return_qty=array();
                           $sql='Select sum(rrd.return_qty) as ret_qty,sum(rrd.return_value) as ret_value from return_receive_details rrd left join return_receive rr on rrd.rr_id=rr.rr_id where rrd.rr_date>="'.$from_date.'" and rrd.rr_date<="'.$too_date.'" and rrd.item_id='.$item_info['id'].' and rrd.rr_d_status="returned" and rr.branch_id='.$branch_id;
                           $return_qty=$this->m_common->customeQuery($sql);
                           if(!empty($return_qty[0]['ret_qty'])){
                                $data['items'][$key]['return_qty']=$return_qty[0]['ret_qty'];
                                $data['items'][$key]['return_value']=$return_qty[0]['ret_value'];
                                $data['items'][$key]['return_rate']=round($return_qty[0]['ret_value']/$return_qty[0]['ret_qty'],2);
                           }else{
                               $data['items'][$key]['return_qty']='-'; 
                               $data['items'][$key]['return_value']='-';
                               $data['items'][$key]['return_rate']='-';
                           }







                           $total_issue_qty=$data['items'][$key]['issue_qty']+ $data['items'][$key]['return_qty']+ $data['items'][$key]['delivery_qty']; 
                           $total_issue_value=$data['items'][$key]['issue_value']+$data['items'][$key]['return_value']+$data['items'][$key]['delivery_value'];
                           $total_issue_rate=round($total_issue_value/$total_issue_qty,2);
       //                    $data['items'][$key]['total_issue_qty']=$total_issue_qty; 
       //                    $data['items'][$key]['total_issue_value']= $total_issue_value;
       //                    $data['items'][$key]['total_issue_rate']= $total_issue_value/$total_issue_qty;
                          if(!empty($total_issue_qty)){
                               $data['items'][$key]['total_issue_qty']=$total_issue_qty;
                          }else{
                             $data['items'][$key]['total_issue_qty']='-'; 
                          }
                          if(!empty($total_issue_value)){
                               $data['items'][$key]['total_issue_value']=$total_issue_value;
                          }else{
                             $data['items'][$key]['total_issue_value']='-'; 
                          }
                          if(!empty($total_issue_rate)){
                               $data['items'][$key]['total_issue_rate']=$total_issue_rate;
                          }else{
                             $data['items'][$key]['total_issue_rate']='-'; 
                          }

                           $balance=$avilable_quantity-$total_issue_qty; 
                           $balance_value=$avilable_value-$total_issue_value; 
                           $balance_rate=round($balance_value/$balance,2); 
       //                    $data['items'][$key]['closing_balance']=$avilable_quantity-$total_issue_qty; 
       //                    $data['items'][$key]['closing_value']=$avilable_value-$total_issue_value;
       //                    $data['items'][$key]['closing_rate']=round($balance_value/$balance,2); 
                          if(!empty($balance)){
                               $data['items'][$key]['closing_balance']=$balance;
                          }else{
                             $data['items'][$key]['closing_balance']='-'; 
                          }
                          if(!empty($balance_value)){
                               $data['items'][$key]['closing_value']=$balance_value;
                          }else{
                             $data['items'][$key]['closing_value']='-'; 
                          }
                          if(!empty($balance_rate)){
                               $data['items'][$key]['closing_rate']=$balance_rate;
                          }else{
                             $data['items'][$key]['closing_rate']='-'; 
                          }


       //                    if(empty( $data['items'][$key]['opening_balance']) && empty( $data['items'][$key]['receive_qty']) && empty( $data['items'][$key]['issue_return_qty']) && empty( $data['items'][$key]['mrr_receive_qty']) && empty( $data['items'][$key]['issue_qty']) && empty( $data['items'][$key]['delivery_qty']) && empty( $data['items'][$key]['return_qty']) && empty( $data['items'][$key]['total_issue_qty']) && empty( $data['items'][$key]['closing_balance']) ){
       //                        unset( $data['items'][$key]);
       //                    }

                           if($data['items'][$key]['opening_balance']=='-' && $data['items'][$key]['receive_qty']=='-' &&$data['items'][$key]['issue_return_qty']=='-' &&$data['items'][$key]['mrr_receive_qty']=='-' &&$data['items'][$key]['issue_qty']=='-' &&$data['items'][$key]['delivery_qty']=='-' &&$data['items'][$key]['return_qty']=='-' &&$data['items'][$key]['total_issue_qty']=='-' &&$data['items'][$key]['closing_balance']=='-'){
                              unset( $data['items'][$key]); 
                           }



                       }
                }
                
                $data['data']=$data['items'];
           }else{
                $details_info=array();
                $j=0;
                $opening_from_date="2021-01-01";
                $opening_to_date=date('Y-m-d', strtotime('-1 day', strtotime($from_date)));
               // $opeing_info=$this->m_common->get_row_array('tbl_item_opening_stock',array('item_id'=>$item,'unit_id'=>$branch_id),'*');
               if(empty($brand_id)){ 
                    $opeing_info=array();
                    $ope_sql="select sum(opening_stock) as total_opening_stock,sum(opening_amount) as total_opening_value from tbl_item_opening_stock where item_id=$item and unit_id=$branch_id";
                    $opeing_info=$this->m_common->customeQuery($ope_sql); 

                    $adjustment_qty=array();
                    $sql='Select sum(qty) as adjust_qty,sum(amount) as adjust_value from tbl_item_adjustment where date<"'.$opening_to_date.'" and item_id='.$item.' and is_active=1 and status="Confirmed" and unit_id='.$branch_id;
                    $adjustment_qty=$this->m_common->customeQuery($sql);

                    $receive_qty=array();  
                    $sql='Select sum(tmrrd.receive_qty) as re_qty,sum(tmrrd.amount) as re_value from tbl_material_receive_requisition_details tmrrd left join material_receive_requisition mrr on tmrrd.mrr_id=mrr.mrr_id  where tmrrd.receive_date>="'.$opening_from_date.'" and tmrrd.receive_date<="'.$opening_to_date.'" and tmrrd.item_id='.$item.' and mrr.mrr_status="received" and mrr.unit_id='.$branch_id;
                    $receive_qty=$this->m_common->customeQuery($sql);

                    $issue_return_qty=array();   
                    $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date>="'.$opening_from_date.'" and ir_date<="'.$opening_to_date.'" and item_id='.$item.' and ir_d_status="received" ';
                    $issue_return_qty=$this->m_common->customeQuery($sql);

                    $mrr_return_receive=array();   
                    $sql='Select sum(mrrd.receive_qty) as mrr_receive_qty,sum(mrrd.receive_value) as mrr_receive_value from mrr_return_receive_details mrrd left join mrr_return_receive mrr on mrrd.mrr_rr_id=mrr.mrr_rr_id where mrrd.receive_date>="'.$opening_from_date.'" and mrrd.receive_date<="'.$opening_to_date.'" and mrrd.item_id='.$item.' and mrrd.mrr_rr_d_status="received" and mrr.branch_id='.$branch_id;
                    $mrr_return_receive=$this->m_common->customeQuery($sql);

                    $total_receive_qty=$receive_qty[0]['re_qty']+$issue_return_qty[0]['is_ret_qty']+$mrr_return_receive[0]['mrr_receive_qty']+$adjustment_qty[0]['adjust_qty'];
                    $total_receive_value=$receive_qty[0]['re_value']+$issue_return_qty[0]['is_ret_value']+$mrr_return_receive[0]['mrr_receive_value']+$adjustment_qty[0]['adjust_value'];

                    $issue_qty=array();   
                    $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$opening_from_date.'" and consumption_date<="'.$opening_to_date.'" and item_id='.$item.' and status="Approved" and unit_id='.$branch_id;
                    $issue_qty=$this->m_common->customeQuery($sql);

                    $delivery_issue_qty=array();  
                    $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where issue_date>="'.$opening_from_date.'" and issue_date<="'.$opening_to_date.'" and item_id='.$item.' and issue_status="issued" and issue_type="delivey" ';
                    $delivery_issue_qty=$this->m_common->customeQuery($sql);


                    $return_qty=array();  
                    $sql='Select sum(rrd.return_qty) as ret_qty,sum(rrd.return_value) as ret_value from return_receive_details rrd left join return_receive rr on rrd.rr_id=rr.rr_id where rrd.rr_date>="'.$opening_from_date.'" and rrd.rr_date<="'.$opening_to_date.'" and rrd.item_id='.$item.' and rrd.rr_d_status="returned" and rr.branch_id='.$branch_id;
                    $return_qty=$this->m_common->customeQuery($sql);

                    $total_issue_qty=$issue_qty[0]['issue_qty']+$delivery_issue_qty[0]['issue_qty']+$return_qty[0]['ret_qty'];
                    $total_issue_value=$issue_qty[0]['issue_value']+$delivery_issue_qty[0]['issue_value']+$return_qty[0]['ret_value'];

                    $closing_qty=$total_receive_qty+$opeing_info[0]['total_opening_stock']-$total_issue_qty;
                    $closing_value=$total_receive_value+$opeing_info[0]['total_opening_value']-$total_issue_value;
                    $closing_rate=round($closing_value/$closing_qty,2);
               }else{
                    $opeing_info=array();
                    $ope_sql="select sum(opening_stock) as total_opening_stock,sum(opening_amount) as total_opening_value from tbl_item_opening_stock where brand_id=$brand_id and item_id=$item and unit_id=$branch_id";
                    $opeing_info=$this->m_common->customeQuery($ope_sql); 

                    $adjustment_qty=array();
                    $sql='Select sum(qty) as adjust_qty,sum(amount) as adjust_value from tbl_item_adjustment where  date<"'.$opening_to_date.'" and item_id='.$item.' and brand_id='.$brand_id.' and is_active=1 and status="Confirmed" and unit_id='.$branch_id;
                    $adjustment_qty=$this->m_common->customeQuery($sql);

                    $receive_qty=array();  
                    $sql='Select sum(tmrrd.receive_qty) as re_qty,sum(tmrrd.amount) as re_value from tbl_material_receive_requisition_details tmrrd left join material_receive_requisition mrr on tmrrd.mrr_id=mrr.mrr_id  where tmrrd.receive_date>="'.$opening_from_date.'" and tmrrd.receive_date<="'.$opening_to_date.'" and tmrrd.item_id='.$item.' and tmrrd.brand_id='.$brand_id.' and mrr.mrr_status="received" and mrr.unit_id='.$branch_id;
                    $receive_qty=$this->m_common->customeQuery($sql);

                    $issue_return_qty=array();   
                    $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date>="'.$opening_from_date.'" and ir_date<="'.$opening_to_date.'" and item_id='.$item.' and brand_id='.$brand_id.' and ir_d_status="received" ';
                    $issue_return_qty=$this->m_common->customeQuery($sql);

                    $mrr_return_receive=array();   
                    $sql='Select sum(mrrd.receive_qty) as mrr_receive_qty,sum(mrrd.receive_value) as mrr_receive_value from mrr_return_receive_details mrrd left join mrr_return_receive mrr on mrrd.mrr_rr_id=mrr.mrr_rr_id where mrrd.receive_date>="'.$opening_from_date.'" and mrrd.receive_date<="'.$opening_to_date.'" and mrrd.item_id='.$item.' and mrrd.brand_id='.$brand_id.' and mrrd.mrr_rr_d_status="received" and mrr.branch_id='.$branch_id;
                    $mrr_return_receive=$this->m_common->customeQuery($sql);

                    $total_receive_qty=$receive_qty[0]['re_qty']+$issue_return_qty[0]['is_ret_qty']+$mrr_return_receive[0]['mrr_receive_qty']+$adjustment_qty[0]['adjust_qty'];
                    $total_receive_value=$receive_qty[0]['re_value']+$issue_return_qty[0]['is_ret_value']+$mrr_return_receive[0]['mrr_receive_value']+$adjustment_qty[0]['adjust_value'];

                    $issue_qty=array();   
                    $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$opening_from_date.'" and consumption_date<="'.$opening_to_date.'" and item_id='.$item.' and brand_id='.$brand_id.' and status="Approved" and unit_id='.$branch_id;
                    $issue_qty=$this->m_common->customeQuery($sql);

                    $delivery_issue_qty=array();  
                    $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where issue_date>="'.$opening_from_date.'" and issue_date<="'.$opening_to_date.'" and item_id='.$item.' and brand_id='.$brand_id.' and issue_status="issued" and issue_type="delivey" ';
                    $delivery_issue_qty=$this->m_common->customeQuery($sql);


                    $return_qty=array();  
                    $sql='Select sum(rrd.return_qty) as ret_qty,sum(rrd.return_value) as ret_value from return_receive_details rrd left join return_receive rr on rrd.rr_id=rr.rr_id where rrd.rr_date>="'.$opening_from_date.'" and rrd.rr_date<="'.$opening_to_date.'" and rrd.item_id='.$item.' and rrd.brand_id='.$brand_id.' and rrd.rr_d_status="returned" and rr.branch_id='.$branch_id;
                    $return_qty=$this->m_common->customeQuery($sql);

                    $total_issue_qty=$issue_qty[0]['issue_qty']+$delivery_issue_qty[0]['issue_qty']+$return_qty[0]['ret_qty'];
                    $total_issue_value=$issue_qty[0]['issue_value']+$delivery_issue_qty[0]['issue_value']+$return_qty[0]['ret_value'];

                    $closing_qty=$total_receive_qty+$opeing_info[0]['total_opening_stock']-$total_issue_qty;
                    $closing_value=$total_receive_value+$opeing_info[0]['total_opening_value']-$total_issue_value;
                    $closing_rate=round($closing_value/$closing_qty,2);
               }
               
              
               
               for($i=$from_date;$i<=$too_date;$i=date('Y-m-d', strtotime('+1 day', strtotime($i))) ){
                   $opening_qty=$closing_qty;
                   $opening_value=$closing_value;
                   $current_rate=$closing_rate;
                   $details_info[$j]['date']=date('d-m-Y',strtotime($i));
                   $details_info[$j]['opening_balance']=$opening_qty;
                   $details_info[$j]['opening_value']=$opening_value;
                   $details_info[$j]['opening_rate']=$current_rate;
                   if(!empty($opening_qty)){
                       $details_info[$j]['opening_balance']=$opening_qty;
                   }else{
                      $details_info[$j]['opening_balance']='-'; 
                   }
                   if(!empty($opening_value)){
                      $details_info[$j]['opening_value']=$opening_value;
                   }else{
                      $details_info[$j]['opening_value']='-'; 
                   }
                   if(!empty($current_rate)){
                       $details_info[$j]['opening_rate']=$current_rate;
                   }else{
                      $details_info[$j]['opening_rate']='-'; 
                   }
                   
                   $receive_qty=array();
                   
                   if(empty($brand_id)){
                        $sql='Select sum(tmrrd.receive_qty) as re_qty,sum(tmrrd.amount) as re_value  from tbl_material_receive_requisition_details tmrrd left join material_receive_requisition mrr on tmrrd.mrr_id=mrr.mrr_id where tmrrd.receive_date="'.$i.'" and tmrrd.item_id='.$item.' and mrr.mrr_status="received" and mrr.unit_id='.$branch_id;
                        $receive_qty=$this->m_common->customeQuery($sql);
                   }else{
                        $sql='Select sum(tmrrd.receive_qty) as re_qty,sum(tmrrd.amount) as re_value  from tbl_material_receive_requisition_details tmrrd left join material_receive_requisition mrr on tmrrd.mrr_id=mrr.mrr_id where tmrrd.receive_date="'.$i.'" and tmrrd.item_id='.$item.' and tmrrd.brand_id='.$brand_id.' and mrr.mrr_status="received" and mrr.unit_id='.$branch_id;
                        $receive_qty=$this->m_common->customeQuery($sql);
                   }

                   $receive_rate=round($receive_qty[0]['re_value']/$receive_qty[0]['re_qty'],2);
                   if(!empty($receive_qty[0]['re_qty'])){
                    $details_info[$j]['receive_qty']=$receive_qty[0]['re_qty'];
                   }else{
                        $details_info[$j]['receive_qty']='-';
                   }
                   if(!empty($receive_qty[0]['re_value'])){
                    $details_info[$j]['receive_value']=$receive_qty[0]['re_value'];
                   }else{
                        $details_info[$j]['receive_value']='-';
                   }
                  if(!empty($receive_rate)){
                    $details_info[$j]['receive_rate']=$receive_rate;
                   }else{
                        $details_info[$j]['receive_rate']='-';
                   }
                  
                   $issue_return_qty=array();
                   if(empty($brand_id)){
                        $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date="'.$i.'" and item_id='.$item.' and ir_d_status="received" ';
                        $issue_return_qty=$this->m_common->customeQuery($sql);
                   }else{
                        $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date="'.$i.'" and item_id='.$item.' and brand_id='.$brand_id.' and ir_d_status="received" ';
                        $issue_return_qty=$this->m_common->customeQuery($sql);
                   }
                   
                   $details_info[$j]['issue_return_rate']=$issue_return_qty[0]['is_ret_value']/$issue_return_qty[0]['is_ret_qty'];
                   $return_issue_rate=round($issue_return_qty[0]['is_ret_value']/$issue_return_qty[0]['is_ret_qty'],2);
                   
                   if(!empty($issue_return_qty[0]['is_ret_qty'])){
                        $details_info[$j]['issue_return_qty']=$issue_return_qty[0]['is_ret_qty'];
                   }else{
                        $details_info[$j]['issue_return_qty']='-';
                   }
                   if(!empty($issue_return_qty[0]['is_ret_value'])){
                        $details_info[$j]['issue_return_value']=$issue_return_qty[0]['is_ret_value'];
                   }else{
                        $details_info[$j]['issue_return_value']='-';
                   }
                  if(!empty($return_issue_rate)){
                        $details_info[$j]['issue_return_rate']=$return_issue_rate;
                   }else{
                        $details_info[$j]['issue_return_rate']='-';
                   }
                   
                   
                   $mrr_return_receive=array();
                   if(empty($brand_id)){
                        $sql='Select sum(mrrd.receive_qty) as mrr_receive_qty,sum(mrrd.receive_value) as mrr_receive_value from mrr_return_receive_details mrrd left join mrr_return_receive mrr on mrrd.mrr_rr_id=mrr.mrr_rr_id  where mrrd.receive_date="'.$i.'" and mrrd.item_id='.$item.' and mrrd.mrr_rr_d_status="received" and mrr.branch_id='.$branch_id;
                        $mrr_return_receive=$this->m_common->customeQuery($sql);
                   }else{
                        $sql='Select sum(mrrd.receive_qty) as mrr_receive_qty,sum(mrrd.receive_value) as mrr_receive_value from mrr_return_receive_details mrrd left join mrr_return_receive mrr on mrrd.mrr_rr_id=mrr.mrr_rr_id  where mrrd.receive_date="'.$i.'" and mrrd.item_id='.$item.' and mrrd.brand_id='.$brand_id.' and mrrd.mrr_rr_d_status="received" and mrr.branch_id='.$branch_id;
                        $mrr_return_receive=$this->m_common->customeQuery($sql);
                   }
                   
                   $details_info[$j]['mrr_receive_rate']=$issue_return_qty[0]['mrr_receive_value']/$issue_return_qty[0]['mrr_receive_qty'];
                   $mrr_receive_rate=round($mrr_return_receive[0]['mrr_receive_value']/$mrr_return_receive[0]['mrr_receive_qty'],2);
                   
                   if(!empty($mrr_return_receive[0]['mrr_receive_qty'])){
                        $details_info[$j]['mrr_receive_qty']=$mrr_return_receive[0]['mrr_receive_qty'];
                   }else{
                        $details_info[$j]['mrr_receive_qty']='-';
                   }
                   if(!empty($mrr_return_receive[0]['mrr_receive_value'])){
                        $details_info[$j]['mrr_receive_value']=$mrr_return_receive[0]['mrr_receive_value'];
                   }else{
                        $details_info[$j]['mrr_receive_value']='-';
                   }
                   if(!empty($mrr_receive_rate)){
                        $details_info[$j]['mrr_receive_rate']=$mrr_receive_rate;
                   }else{
                        $details_info[$j]['mrr_receive_rate']='-';
                   }
                   
                   
                   $adjustment_qty=array();
                   if(empty($brand_id)){
                        $sql='Select sum(qty) as adjust_qty,sum(amount) as adjust_value from tbl_item_adjustment where date="'.$i.'" and item_id='.$item.' and is_active=1 and status="Confirmed" and unit_id='.$branch_id;
                        $adjustment_qty=$this->m_common->customeQuery($sql);
                   }else{
                        $sql='Select sum(qty) as adjust_qty,sum(amount) as adjust_value from tbl_item_adjustment where date="'.$i.'" and item_id='.$item.' and brand_id='.$brand_id.' and is_active=1 and status="Confirmed" and unit_id='.$branch_id;
                        $adjustment_qty=$this->m_common->customeQuery($sql);
                   }
                   if(!empty($adjustment_qty[0]['adjust_qty'])){
                        $details_info[$j]['adjust_qty']=$adjustment_qty[0]['adjust_qty'];
                        $details_info[$j]['adjust_value']=$adjustment_qty[0]['adjust_value'];
                        $details_info[$j]['adjust_rate']=$adjustment_qty[0]['adjust_value']/$adjustment_qty[0]['adjust_qty'];
                   }else{
                        $details_info[$j]['adjust_qty']='-';
                        $details_info[$j]['adjust_value']='-';
                        $details_info[$j]['adjust_rate']='-';
                   }
                   
                   
                   

                   $total_receive_qty=$receive_qty[0]['re_qty']+$issue_return_qty[0]['is_ret_qty']+$mrr_return_receive[0]['mrr_receive_qty']+$adjustment_qty[0]['adjust_qty'];
                   $total_receive_value=$receive_qty[0]['re_value']+$issue_return_qty[0]['is_ret_value']+$mrr_return_receive[0]['mrr_receive_value']+$adjustment_qty[0]['adjust_value'];
                   $avilable_quantity=$total_receive_qty+$opening_qty;
                   $avilable_value=$total_receive_value+$opening_value;
                   $avilable_rate=round($avilable_value/$avilable_quantity,2);
               
                   if(!empty($avilable_quantity)){
                        $details_info[$j]['total_rec_ret_qty']=$avilable_quantity;
                   }else{
                        $details_info[$j]['total_rec_ret_qty']='-';
                   }
                   if(!empty($avilable_value)){
                        $details_info[$j]['total_rec_ret_value']=$avilable_value;
                   }else{
                        $details_info[$j]['total_rec_ret_value']='-';
                   }
                  if(!empty($avilable_rate)){
                        $details_info[$j]['total_rec_ret_rate']=$avilable_rate;
                   }else{
                        $details_info[$j]['total_rec_ret_rate']='-';
                   }
                   $issue_qty=array();
                   
                   if(empty($brand_id)){
                        $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date="'.$i.'" and item_id='.$item.' and status="Approved" and unit_id='.$branch_id;
                        $issue_qty=$this->m_common->customeQuery($sql);
                   }else{
                        $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date="'.$i.'" and item_id='.$item.' and brand_id='.$brand_id.' and status="Approved" and unit_id='.$branch_id;
                        $issue_qty=$this->m_common->customeQuery($sql);
                   }
                   
                   $details_info[$j]['issue_rate']=$issue_qty[0]['issue_value']/$issue_qty[0]['issue_qty'];
                   $issue_rate=round($issue_qty[0]['issue_value']/$issue_qty[0]['issue_qty'],2);
                   if(!empty($issue_qty[0]['issue_qty'])){
                        $details_info[$j]['issue_qty']=$issue_qty[0]['issue_qty'];
                   }else{
                        $details_info[$j]['issue_qty']='-';
                   }
                   if(!empty($issue_qty[0]['issue_value'])){
                        $details_info[$j]['issue_value']=$issue_qty[0]['issue_value'];
                   }else{
                        $details_info[$j]['issue_value']='-';
                   }
                  if(!empty($issue_rate)){
                        $details_info[$j]['issue_rate']=$issue_rate;
                   }else{
                        $details_info[$j]['issue_rate']='-';
                   }
                   $delivery_issue_qty=array();
                   if(empty($brand_id)){
                        $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where issue_date="'.$i.'" and item_id='.$item.' and issue_status="issued" and issue_type="delivey" ';
                        $delivery_issue_qty=$this->m_common->customeQuery($sql);
                   }else{
                        $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where issue_date="'.$i.'" and item_id='.$item.' and brand_id='.$brand_id.' and issue_status="issued" and issue_type="delivey" ';
                        $delivery_issue_qty=$this->m_common->customeQuery($sql);
                   }
                   
                   $details_info[$j]['delivery_rate']=$delivery_issue_qty[0]['issue_value']/$delivery_issue_qty[0]['issue_qty'];
                   $delivery_rate=round($delivery_issue_qty[0]['issue_value']/$delivery_issue_qty[0]['issue_qty'],2);
                   if(!empty($delivery_issue_qty[0]['issue_qty'])){
                        $details_info[$j]['delivery_qty']=$delivery_issue_qty[0]['issue_qty'];
                   }else{
                        $details_info[$j]['delivery_qty']='-';
                   }
                   if(!empty($delivery_issue_qty[0]['issue_value'])){
                        $details_info[$j]['delivery_value']=$delivery_issue_qty[0]['issue_value'];
                   }else{
                        $details_info[$j]['delivery_value']='-';
                   }
                   if(!empty($delivery_rate)){
                        $details_info[$j]['delivery_rate']=$delivery_rate;
                   }else{
                        $details_info[$j]['delivery_rate']='-';
                   }
                   $return_qty=array();
                   if(empty($brand_id)){
                        $sql='Select sum(rrd.return_qty) as ret_qty,sum(rrd.return_value) as ret_value from return_receive_details rrd left join return_receive rr on rrd.rr_id=rr.rr_id where rrd.rr_date="'.$i.'" and rrd.item_id='.$item.' and rrd.rr_d_status="returned" and rr.branch_id='.$branch_id;
                        $return_qty=$this->m_common->customeQuery($sql);
                   }else{
                        $sql='Select sum(rrd.return_qty) as ret_qty,sum(rrd.return_value) as ret_value from return_receive_details rrd left join return_receive rr on rrd.rr_id=rr.rr_id where rrd.rr_date="'.$i.'" and rrd.item_id='.$item.' and rrd.brand_id='.$brand_id.' and rrd.rr_d_status="returned" and rr.branch_id='.$branch_id;
                        $return_qty=$this->m_common->customeQuery($sql);
                   }
                   
                   $details_info[$j]['return_rate']=$return_qty[0]['ret_value']/$return_qty[0]['ret_qty'];
                   $return_rate=round($return_qty[0]['ret_value']/$return_qty[0]['ret_qty'],2);
                   if(!empty($return_qty[0]['return_qty'])){
                        $details_info[$j]['return_qty']=$return_qty[0]['return_qty'];
                   }else{
                        $details_info[$j]['return_qty']='-';
                   }
                   if(!empty($return_qty[0]['return_value'])){
                        $details_info[$j]['return_value']=$return_qty[0]['return_value'];
                   }else{
                        $details_info[$j]['return_value']='-';
                   }
                  if(!empty($return_rate)){
                        $details_info[$j]['return_rate']=$return_rate;
                   }else{
                        $details_info[$j]['return_rate']='-';
                   }

                   $total_issue_qty=$issue_qty[0]['issue_qty']+$delivery_issue_qty[0]['issue_qty']+$return_qty[0]['ret_qty'];
                   $total_issue_value=$issue_qty[0]['issue_value']+$delivery_issue_qty[0]['issue_value']+$return_qty[0]['ret_value'];
                   $total_issue_rate=round($total_issue_value/$total_issue_qty,2);
                   
                   $details_info[$j]['total_issue_rate']= $total_issue_value/$total_issue_qty;
                   if(!empty($total_issue_qty)){
                        $details_info[$j]['total_issue_qty']=$total_issue_qty;
                   }else{
                        $details_info[$j]['total_issue_qty']='-';
                   }
                   if(!empty($total_issue_value)){
                        $details_info[$j]['total_issue_value']=$total_issue_value;
                   }else{
                        $details_info[$j]['total_issue_value']='-';
                   }
                  if(!empty($total_issue_rate)){
                        $details_info[$j]['total_issue_rate']=$total_issue_rate;
                   }else{
                        $details_info[$j]['total_issue_rate']='-';
                   }
                    
                  $closing_qty=$total_receive_qty+$opening_qty-$total_issue_qty;
                  $closing_value=$total_receive_value+$opening_value-$total_issue_value;
                  $closing_rate=round($closing_value/$closing_qty,2);
                  
                  $details_info[$j]['closing_balance']=$closing_qty;
                  $details_info[$j]['closing_value']=$closing_value;
                  $details_info[$j]['closing_rate']=$closing_rate;
                   if(!empty($closing_qty)){
                        $details_info[$j]['closing_balance']=$closing_qty;
                   }else{
                        $details_info[$j]['closing_balance']='-';
                   }
                   if(!empty($closing_value)){
                        $details_info[$j]['closing_value']=$closing_value;
                   }else{
                        $details_info[$j]['closing_value']='-';
                   }
                  if(!empty($closing_rate)){
                        $details_info[$j]['closing_rate']=$closing_rate;
                   }else{
                        $details_info[$j]['closing_rate']='-';
                   }
                   
                  if($j >0 && $details_info[$j]['receive_qty']=='-' && $details_info[$j]['issue_return_qty']=='-' && $details_info[$j]['mrr_receive_qty']=='-' && $details_info[$j]['issue_qty']=='-' && $details_info[$j]['delivery_qty']=='-'&& $details_info[$j]['return_qty']=='-'  ){
                      unset($details_info[$j]);
                  } 
                  
                  $j++;
               }
               $data['data']=$details_info;
           }

         
               
          
        }else{
           $item='';
           $f_date='';
           $to_date='';
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*'); 
        }
       // $this->load->view('report/store_ledger',$data);
         if($print==false){
             $this->load->view('report/store_ledger',$data);
        }else{
           $html=$this->load->view('report/print_store_ledger', $data,true);
           echo $html;exit; 
        }
        
    }
    
    function binCartReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $branch_id= $this->session->userdata('companyId');
        
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $data['report_format']=$report_format;
           $item=$this->input->post('item');
           
           if($item!='all'){
                $item_info=$this->m_common->get_row_array('items',array('id'=>$item),'*');
                $brands= $this->m_common->get_row_array('tbl_item_brand',array('is_active'=>1), '*');
                $item_brands=  unserialize($item_info[0]['brand_id']);
                $b=array();
                foreach($brands as $key1=>$brand){
                        if(!empty($item_brands)){  
                            if(in_array($brand['id'],$item_brands)){
                              $b[]=$brand;
                            }else{
                                 unset($brands[$key1]);
                            }
                        }else{
                            $b='';
                        }
                }        
                $data['brands']=$b;
           }else{
               $data['brands']='';
           }
           
           
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $brand_id=$this->input->post('brand_id');
           
           $from_date=date('Y-m-d',strtotime($f_date));
           $too_date=date('Y-m-d',strtotime($to_date));
           $data['item_id']=$item;
           $data['brand_id']=$brand_id;
           $data['item_check']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           
           if($report_format=='general'){
                    $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                    if($item=="all"){
                       $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                    }else{
                        $data['items']=$this->m_common->get_row_array('items',array('id'=>$item),'*'); 
                    }
           }else{
               //$data['groups']=$this->m_common->get_row_array('item_groups','','*');
                $data['groups']=$this->m_common->get_row_array('item_groups',array('group_type'=>"Consumable"),'*');
                   
               //$data['items']=$this->m_common->get_row_array('items',array('item_group'=>$item),'*','','','item_name'); 
               if($item=='all'){
                   $data['group']=$this->m_common->get_row_array('item_groups',array('group_type'=>"Consumable"),'*');
                   foreach($data['group'] as $key=>$group){
                     $data['group'][$key]['group_items']=$this->m_common->get_row_array('items',array('item_group'=>$group['id']),'*','','','item_name');  
                   }
               }else{
                   $data['items']=$this->m_common->get_row_array('items',array('item_group'=>$item),'*','','','item_name'); 
                   $data['group_info']=$this->m_common->get_row_array('item_groups',array('id'=>$item),'*'); 
               }
                    
               
           }
           if(($report_format=='general' && $item=="all") || $report_format=='group' ){
               
                           foreach($data['items'] as $key=>$item_info){


                           //This part is for opening calculation
                           $opening_from_date="2021-01-01";
                           $opening_to_date=date('Y-m-d', strtotime('-1 day', strtotime($from_date)));
                           //$opeing_info=$this->m_common->get_row_array('tbl_item_opening_stock',array('item_id'=>$item_info['id'],'unit_id'=>$branch_id),'*');
                           $opeing_info=array();
                           $ope_sql="select sum(opening_stock) as total_opening_stock,sum(opening_amount) as total_opening_value from tbl_item_opening_stock where item_id=".$item_info['id']." and unit_id=$branch_id";
                           $opeing_info=$this->m_common->customeQuery($ope_sql);
                           
                           
                           $adjustment_qty=array();
                           $sql='Select sum(qty) as adjust_qty,sum(amount) as adjust_value from tbl_item_adjustment where date<"'.$opening_to_date.'" and item_id='.$item_info['id'].' and is_active=1 and status="Confirmed" and unit_id='.$branch_id;
                           $adjustment_qty=$this->m_common->customeQuery($sql);
                           
                           
                           $receive_qty=array();

                           $sql='Select sum(tmrrd.receive_qty) as re_qty,sum(tmrrd.amount) as re_value from tbl_material_receive_requisition_details tmrrd left join material_receive_requisition mrr on tmrrd.mrr_id=mrr.mrr_id  where tmrrd.receive_date>="'.$opening_from_date.'" and tmrrd.receive_date<="'.$opening_to_date.'" and tmrrd.item_id='.$item_info['id'].' and mrr.mrr_status="received" and mrr.unit_id='.$branch_id;
                           $receive_qty=$this->m_common->customeQuery($sql);

                           $issue_return_qty=array();
                           $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date>="'.$opening_from_date.'" and ir_date<="'.$opening_to_date.'" and item_id='.$item_info['id'].' and ir_d_status="received" ';
                           $issue_return_qty=$this->m_common->customeQuery($sql);

                           $mrr_return_receive=array();
                           $sql='Select sum(mrrd.receive_qty) as mrr_receive_qty,sum(mrrd.receive_value) as mrr_receive_value from mrr_return_receive_details mrrd left join mrr_return_receive mrr on mrrd.mrr_rr_id=mrr.mrr_rr_id where mrrd.receive_date>="'.$opening_from_date.'" and mrrd.receive_date<="'.$opening_to_date.'" and mrrd.item_id='.$item_info['id'].' and mrrd.mrr_rr_d_status="received" ';
                           $mrr_return_receive=$this->m_common->customeQuery($sql);

                           $total_receive_qty=$receive_qty[0]['re_qty']+$issue_return_qty[0]['is_ret_qty']+$mrr_return_receive[0]['mrr_receive_qty']+$adjustment_qty[0]['adjust_qty'];
                           $total_receive_value=$receive_qty[0]['re_value']+$issue_return_qty[0]['is_ret_value']+$mrr_return_receive[0]['mrr_receive_value']+$adjustment_qty[0]['adjust_value'];

                          
                          $issue_qty=array();  
                          $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$opening_from_date.'" and consumption_date<="'.$opening_to_date.'" and item_id='.$item_info['id'].' and status="Approved" and unit_id='.$branch_id;
                          $issue_qty=$this->m_common->customeQuery($sql);

                          $delivery_issue_qty=array();
                          $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where issue_date>="'.$opening_from_date.'" and issue_date<="'.$opening_to_date.'" and item_id='.$item_info['id'].' and issue_status="issued" and issue_type="delivey" ';
                          $delivery_issue_qty=$this->m_common->customeQuery($sql);
                          
                          $return_qty=array();  
                          $sql='Select sum(rrd.return_qty) as ret_qty,sum(rrd.return_value) as ret_value from return_receive_details rrd left join return_receive rr on rrd.rr_id=rr.rr_id where rrd.rr_date>="'.$opening_from_date.'" and rrd.rr_date<="'.$opening_to_date.'" and rrd.item_id='.$item_info['id'].' and rrd.rr_d_status="returned" and rr.branch_id='.$branch_id;
                          $return_qty=$this->m_common->customeQuery($sql);

                          $total_issue_qty=$issue_qty[0]['issue_qty']+$delivery_issue_qty[0]['issue_qty']+$return_qty[0]['ret_qty'];
                          $total_issue_value=$issue_qty[0]['issue_value']+$delivery_issue_qty[0]['issue_value']+$return_qty[0]['ret_value'];

                          $opening_qty=$total_receive_qty+$opeing_info[0]['total_opening_stock']-$total_issue_qty;
                          $opening_value=$total_receive_value+$opeing_info[0]['total_opening_value']-$total_issue_value;
                          $current_rate=round($opening_value/$opening_qty,2);

                          if(!empty($opening_qty)){
                               $data['items'][$key]['opening_balance']=$opening_qty;
                          }else{
                             $data['items'][$key]['opening_balance']='-'; 
                          }
                          if(!empty($opening_value)){
                               $data['items'][$key]['opening_value']=$opening_value;
                          }else{
                             $data['items'][$key]['opening_value']='-'; 
                          }
                          if(!empty($current_rate)){
                               $data['items'][$key]['opening_rate']=$current_rate;
                          }else{
                             $data['items'][$key]['opening_rate']='-'; 
                          }




                          //End Opening Calculation 


                           $receive_qty=array();
                           $sql='Select sum(tmrrd.receive_qty) as re_qty,sum(tmrrd.amount) as re_value from tbl_material_receive_requisition_details tmrrd left join material_receive_requisition mrr on tmrrd.mrr_id=mrr.mrr_id where tmrrd.receive_date>="'.$from_date.'" and tmrrd.receive_date<="'.$too_date.'" and tmrrd.item_id='.$item_info['id'].' and mrr.mrr_status="received" and mrr.unit_id='.$branch_id;
                           $receive_qty=$this->m_common->customeQuery($sql);
                           if(!empty($receive_qty[0]['re_qty'])){
                                $data['items'][$key]['receive_qty']=$receive_qty[0]['re_qty'];
                                $data['items'][$key]['receive_value']=$receive_qty[0]['re_value'];
                                $data['items'][$key]['receive_rate']=round($receive_qty[0]['re_value']/$receive_qty[0]['re_qty'],2);
                           }else{
                               $data['items'][$key]['receive_qty']='-'; 
                               $data['items'][$key]['receive_value']='-';
                               $data['items'][$key]['receive_rate']='-';
                           }


                           $issue_return_qty=array();
                           $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date>="'.$from_date.'" and ir_date<="'.$too_date.'" and item_id='.$item_info['id'].' and ir_d_status="received" ';
                           $issue_return_qty=$this->m_common->customeQuery($sql);
                           if(!empty($issue_return_qty[0]['is_ret_qty'])){
                                $data['items'][$key]['issue_return_qty']=$issue_return_qty[0]['is_ret_qty'];
                                $data['items'][$key]['issue_return_value']=$issue_return_qty[0]['is_ret_value'];
                                $data['items'][$key]['issue_return_rate']=round($issue_return_qty[0]['is_ret_value']/$issue_return_qty[0]['is_ret_qty'],2);
                           }else{
                               $data['items'][$key]['issue_return_qty']='-';
                               $data['items'][$key]['issue_return_value']='-';
                               $data['items'][$key]['issue_return_rate']='-';
                           }

                           //this part is for replacement from party
                           $mrr_return_receive=array();
                           $sql='Select sum(mrrd.receive_qty) as mrr_receive_qty,sum(mrrd.receive_value) as mrr_receive_value from mrr_return_receive_details mrrd left join mrr_return_receive mrr on mrrd.mrr_rr_id=mrr.mrr_rr_id where mrrd.receive_date>="'.$from_date.'" and mrrd.receive_date<="'.$too_date.'" and mrrd.item_id='.$item_info['id'].' and mrrd.mrr_rr_d_status="received" and mrr.branch_id='.$branch_id;
                           $mrr_return_receive=$this->m_common->customeQuery($sql);
                           if(!empty($mrr_return_receive[0]['mrr_receive_qty'])){
                                $data['items'][$key]['mrr_receive_qty']=$mrr_return_receive[0]['mrr_receive_qty'];
                                $data['items'][$key]['mrr_receive_value']=$mrr_return_receive[0]['mrr_receive_value'];
                                $data['items'][$key]['mrr_receive_rate']=round($mrr_return_receive[0]['mrr_receive_value']/$mrr_return_receive[0]['mrr_receive_qty'],2);
                           }else{
                               $data['items'][$key]['mrr_receive_qty']='-';
                               $data['items'][$key]['mrr_receive_value']='-';
                               $data['items'][$key]['mrr_receive_rate']='-';
                           }

           //                $data['items'][$key]['return_receive_qty']=$data['items'][$key]['issue_return_qty']+$data['items'][$key]['mrr_receive_qty'];
           //                $data['items'][$key]['return_receive_value']= $data['items'][$key]['issue_return_value']+$data['items'][$key]['mrr_receive_value'];

                           
                           
                            //this part is for Low or Access Adjustment 
                           
                            $adjustment_qty=array();
                            $sql='Select sum(qty) as adjust_qty,sum(amount) as adjust_value from tbl_item_adjustment where date>="'.$from_date.'" and date<="'.$too_date.'" and item_id='.$item_info['id'].' and is_active=1 and status="Confirmed" and unit_id='.$branch_id;
                            $adjustment_qty=$this->m_common->customeQuery($sql);
                            if(!empty($adjustment_qty[0]['adjust_qty'])){
                                 $data['items'][$key]['adjust_qty']=$adjustment_qty[0]['adjust_qty'];
                                 $data['items'][$key]['adjust_value']=$adjustment_qty[0]['adjust_value'];
                                 $data['items'][$key]['adjust_rate']=$adjustment_qty[0]['adjust_value']/$adjustment_qty[0]['adjust_qty'];
                            }else{
                                 $data['items'][$key]['adjust_qty']='-';
                                 $data['items'][$key]['adjust_value']='-';
                                 $data['items'][$key]['adjust_rate']='-';
                            }
                           
                           
                           


                           $avilable_quantity=$data['items'][$key]['receive_qty']+$data['items'][$key]['issue_return_qty']+$data['items'][$key]['mrr_receive_qty']+$data['items'][$key]['adjust_qty']+$opening_qty;
                           $avilable_value=$data['items'][$key]['receive_value']+ $data['items'][$key]['issue_return_value']+$data['items'][$key]['mrr_receive_value']+$data['items'][$key]['adjust_value']+$opening_value;
                           $available_rate=round($avilable_value/$avilable_quantity,2);
       //                    $data['items'][$key]['total_rec_ret_qty']=$data['items'][$key]['receive_qty']+$data['items'][$key]['issue_return_qty']+$data['items'][$key]['mrr_receive_qty'];
       //                    $data['items'][$key]['total_rec_ret_value']=$data['items'][$key]['receive_value']+ $data['items'][$key]['issue_return_value']+$data['items'][$key]['mrr_receive_value'];
       //                    $data['items'][$key]['total_rec_ret_rate']=round($avilable_value/$avilable_quantity,2);
                          if(!empty($avilable_quantity)){
                               $data['items'][$key]['total_rec_ret_qty']=$avilable_quantity;
                          }else{
                             $data['items'][$key]['total_rec_ret_qty']='-'; 
                          }
                          if(!empty($avilable_value)){
                               $data['items'][$key]['total_rec_ret_value']=$avilable_value;
                          }else{
                             $data['items'][$key]['total_rec_ret_value']='-'; 
                          }
                          if(!empty($available_rate)){
                               $data['items'][$key]['total_rec_ret_rate']=$available_rate;
                          }else{
                             $data['items'][$key]['total_rec_ret_rate']='-'; 
                          }

                        //This part is for general issue
                           $issue_qty=array();
                           $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$from_date.'" and consumption_date<="'.$too_date.'" and item_id='.$item_info['id'].' and status="Approved" and unit_id='.$branch_id;
                           $issue_qty=$this->m_common->customeQuery($sql);
                           if(!empty($issue_qty[0]['issue_qty'])){
                                $data['items'][$key]['issue_qty']=$issue_qty[0]['issue_qty'];
                                $data['items'][$key]['issue_value']=$issue_qty[0]['issue_value'];
                                $data['items'][$key]['issue_rate']=round($issue_qty[0]['issue_value']/$issue_qty[0]['issue_qty'],2);
                           }else{
                               $data['items'][$key]['issue_qty']='-'; 
                               $data['items'][$key]['issue_value']='-';
                               $data['items'][$key]['issue_rate']='-';
                           }

                          //This part is for delivery issue 
                           $d_issue_qty=array();
                           $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where issue_date>="'.$from_date.'" and issue_date<="'.$too_date.'" and item_id='.$item_info['id'].' and issue_status="issued" and issue_type="delivey" ';
                           $d_issue_qty=$this->m_common->customeQuery($sql);
                           if(!empty($issue_qty[0]['delivery_qty'])){
                                $data['items'][$key]['delivery_qty']=$d_issue_qty[0]['issue_qty'];
                                $data['items'][$key]['delivery_value']=$d_issue_qty[0]['issue_value'];
                                $data['items'][$key]['delivery_rate']=round($d_issue_qty[0]['issue_value']/$d_issue_qty[0]['issue_qty']);
                           }else{
                               $data['items'][$key]['delivery_qty']='-'; 
                               $data['items'][$key]['delivery_value']='-';
                               $data['items'][$key]['delivery_rate']='-';
                           }


                           //This part is for return to party info
                           $return_qty=array();
                           $sql='Select sum(rrd.return_qty) as ret_qty,sum(rrd.return_value) as ret_value from return_receive_details rrd left join return_receive rr on rrd.rr_id=rr.rr_id where rrd.rr_date>="'.$from_date.'" and rrd.rr_date<="'.$too_date.'" and rrd.item_id='.$item_info['id'].' and rrd.rr_d_status="returned" and rr.branch_id='.$branch_id;
                           $return_qty=$this->m_common->customeQuery($sql);
                           if(!empty($return_qty[0]['ret_qty'])){
                                $data['items'][$key]['return_qty']=$return_qty[0]['ret_qty'];
                                $data['items'][$key]['return_value']=$return_qty[0]['ret_value'];
                                $data['items'][$key]['return_rate']=round($return_qty[0]['ret_value']/$return_qty[0]['ret_qty'],2);
                           }else{
                               $data['items'][$key]['return_qty']='-'; 
                               $data['items'][$key]['return_value']='-';
                               $data['items'][$key]['return_rate']='-';
                           }







                           $total_issue_qty=$data['items'][$key]['issue_qty']+ $data['items'][$key]['return_qty']+ $data['items'][$key]['delivery_qty']; 
                           $total_issue_value=$data['items'][$key]['issue_value']+$data['items'][$key]['return_value']+$data['items'][$key]['delivery_value'];
                           $total_issue_rate=round($total_issue_value/$total_issue_qty,2);
       //                    $data['items'][$key]['total_issue_qty']=$total_issue_qty; 
       //                    $data['items'][$key]['total_issue_value']= $total_issue_value;
       //                    $data['items'][$key]['total_issue_rate']= $total_issue_value/$total_issue_qty;
                          if(!empty($total_issue_qty)){
                               $data['items'][$key]['total_issue_qty']=$total_issue_qty;
                          }else{
                             $data['items'][$key]['total_issue_qty']='-'; 
                          }
                          if(!empty($total_issue_value)){
                               $data['items'][$key]['total_issue_value']=$total_issue_value;
                          }else{
                             $data['items'][$key]['total_issue_value']='-'; 
                          }
                          if(!empty($total_issue_rate)){
                               $data['items'][$key]['total_issue_rate']=$total_issue_rate;
                          }else{
                             $data['items'][$key]['total_issue_rate']='-'; 
                          }

                           $balance=$avilable_quantity-$total_issue_qty; 
                           $balance_value=$avilable_value-$total_issue_value; 
                           $balance_rate=round($balance_value/$balance,2); 
       //                    $data['items'][$key]['closing_balance']=$avilable_quantity-$total_issue_qty; 
       //                    $data['items'][$key]['closing_value']=$avilable_value-$total_issue_value;
       //                    $data['items'][$key]['closing_rate']=round($balance_value/$balance,2); 
                          if(!empty($balance)){
                               $data['items'][$key]['closing_balance']=$balance;
                          }else{
                             $data['items'][$key]['closing_balance']='-'; 
                          }
                          if(!empty($balance_value)){
                               $data['items'][$key]['closing_value']=$balance_value;
                          }else{
                             $data['items'][$key]['closing_value']='-'; 
                          }
                          if(!empty($balance_rate)){
                               $data['items'][$key]['closing_rate']=$balance_rate;
                          }else{
                             $data['items'][$key]['closing_rate']='-'; 
                          }


       //                    if(empty( $data['items'][$key]['opening_balance']) && empty( $data['items'][$key]['receive_qty']) && empty( $data['items'][$key]['issue_return_qty']) && empty( $data['items'][$key]['mrr_receive_qty']) && empty( $data['items'][$key]['issue_qty']) && empty( $data['items'][$key]['delivery_qty']) && empty( $data['items'][$key]['return_qty']) && empty( $data['items'][$key]['total_issue_qty']) && empty( $data['items'][$key]['closing_balance']) ){
       //                        unset( $data['items'][$key]);
       //                    }

                           if($data['items'][$key]['opening_balance']=='-' && $data['items'][$key]['receive_qty']=='-' &&$data['items'][$key]['issue_return_qty']=='-' &&$data['items'][$key]['mrr_receive_qty']=='-' &&$data['items'][$key]['issue_qty']=='-' &&$data['items'][$key]['delivery_qty']=='-' &&$data['items'][$key]['return_qty']=='-' &&$data['items'][$key]['total_issue_qty']=='-' &&$data['items'][$key]['closing_balance']=='-'){
                              unset( $data['items'][$key]); 
                           }



                       }
                
                
                $data['data']=$data['items'];
           }else{
                $details_info=array();
                $j=0;
                $opening_from_date="2021-01-01";
                $opening_to_date=date('Y-m-d', strtotime('-1 day', strtotime($from_date)));
               // $opeing_info=$this->m_common->get_row_array('tbl_item_opening_stock',array('item_id'=>$item,'unit_id'=>$branch_id),'*');
               if(empty($brand_id)){ 
                    $opeing_info=array();
                    $ope_sql="select sum(opening_stock) as total_opening_stock,sum(opening_amount) as total_opening_value from tbl_item_opening_stock where item_id=$item and unit_id=$branch_id";
                    $opeing_info=$this->m_common->customeQuery($ope_sql); 

                    $adjustment_qty=array();
                    $sql='Select sum(qty) as adjust_qty,sum(amount) as adjust_value from tbl_item_adjustment where date<"'.$opening_to_date.'" and item_id='.$item.' and is_active=1 and status="Confirmed" and unit_id='.$branch_id;
                    $adjustment_qty=$this->m_common->customeQuery($sql);

                    $receive_qty=array();  
                    $sql='Select sum(tmrrd.receive_qty) as re_qty,sum(tmrrd.amount) as re_value from tbl_material_receive_requisition_details tmrrd left join material_receive_requisition mrr on tmrrd.mrr_id=mrr.mrr_id  where tmrrd.receive_date>="'.$opening_from_date.'" and tmrrd.receive_date<="'.$opening_to_date.'" and tmrrd.item_id='.$item.' and mrr.mrr_status="received" and mrr.unit_id='.$branch_id;
                    $receive_qty=$this->m_common->customeQuery($sql);

                    $issue_return_qty=array();   
                    $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date>="'.$opening_from_date.'" and ir_date<="'.$opening_to_date.'" and item_id='.$item.' and ir_d_status="received" ';
                    $issue_return_qty=$this->m_common->customeQuery($sql);

                    $mrr_return_receive=array();   
                    $sql='Select sum(mrrd.receive_qty) as mrr_receive_qty,sum(mrrd.receive_value) as mrr_receive_value from mrr_return_receive_details mrrd left join mrr_return_receive mrr on mrrd.mrr_rr_id=mrr.mrr_rr_id where mrrd.receive_date>="'.$opening_from_date.'" and mrrd.receive_date<="'.$opening_to_date.'" and mrrd.item_id='.$item.' and mrrd.mrr_rr_d_status="received" and mrr.branch_id='.$branch_id;
                    $mrr_return_receive=$this->m_common->customeQuery($sql);

                    $total_receive_qty=$receive_qty[0]['re_qty']+$issue_return_qty[0]['is_ret_qty']+$mrr_return_receive[0]['mrr_receive_qty']+$adjustment_qty[0]['adjust_qty'];
                    $total_receive_value=$receive_qty[0]['re_value']+$issue_return_qty[0]['is_ret_value']+$mrr_return_receive[0]['mrr_receive_value']+$adjustment_qty[0]['adjust_value'];

                    $issue_qty=array();   
                    $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$opening_from_date.'" and consumption_date<="'.$opening_to_date.'" and item_id='.$item.' and status="Approved" and unit_id='.$branch_id;
                    $issue_qty=$this->m_common->customeQuery($sql);

                    $delivery_issue_qty=array();  
                    $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where issue_date>="'.$opening_from_date.'" and issue_date<="'.$opening_to_date.'" and item_id='.$item.' and issue_status="issued" and issue_type="delivey" ';
                    $delivery_issue_qty=$this->m_common->customeQuery($sql);


                    $return_qty=array();  
                    $sql='Select sum(rrd.return_qty) as ret_qty,sum(rrd.return_value) as ret_value from return_receive_details rrd left join return_receive rr on rrd.rr_id=rr.rr_id where rrd.rr_date>="'.$opening_from_date.'" and rrd.rr_date<="'.$opening_to_date.'" and rrd.item_id='.$item.' and rrd.rr_d_status="returned" and rr.branch_id='.$branch_id;
                    $return_qty=$this->m_common->customeQuery($sql);

                    $total_issue_qty=$issue_qty[0]['issue_qty']+$delivery_issue_qty[0]['issue_qty']+$return_qty[0]['ret_qty'];
                    $total_issue_value=$issue_qty[0]['issue_value']+$delivery_issue_qty[0]['issue_value']+$return_qty[0]['ret_value'];

                    $closing_qty=$total_receive_qty+$opeing_info[0]['total_opening_stock']-$total_issue_qty;
                    $closing_value=$total_receive_value+$opeing_info[0]['total_opening_value']-$total_issue_value;
                    $closing_rate=round($closing_value/$closing_qty,2);
               }else{
                    $opeing_info=array();
                    $ope_sql="select sum(opening_stock) as total_opening_stock,sum(opening_amount) as total_opening_value from tbl_item_opening_stock where brand_id=$brand_id and item_id=$item and unit_id=$branch_id";
                    $opeing_info=$this->m_common->customeQuery($ope_sql); 

                    $adjustment_qty=array();
                    $sql='Select sum(qty) as adjust_qty,sum(amount) as adjust_value from tbl_item_adjustment where  date<"'.$opening_to_date.'" and item_id='.$item.' and brand_id='.$brand_id.' and is_active=1 and status="Confirmed" and unit_id='.$branch_id;
                    $adjustment_qty=$this->m_common->customeQuery($sql);

                    $receive_qty=array();  
                    $sql='Select sum(tmrrd.receive_qty) as re_qty,sum(tmrrd.amount) as re_value from tbl_material_receive_requisition_details tmrrd left join material_receive_requisition mrr on tmrrd.mrr_id=mrr.mrr_id  where tmrrd.receive_date>="'.$opening_from_date.'" and tmrrd.receive_date<="'.$opening_to_date.'" and tmrrd.item_id='.$item.' and tmrrd.brand_id='.$brand_id.' and mrr.mrr_status="received" and mrr.unit_id='.$branch_id;
                    $receive_qty=$this->m_common->customeQuery($sql);

                    $issue_return_qty=array();   
                    $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date>="'.$opening_from_date.'" and ir_date<="'.$opening_to_date.'" and item_id='.$item.' and brand_id='.$brand_id.' and ir_d_status="received" ';
                    $issue_return_qty=$this->m_common->customeQuery($sql);

                    $mrr_return_receive=array();   
                    $sql='Select sum(mrrd.receive_qty) as mrr_receive_qty,sum(mrrd.receive_value) as mrr_receive_value from mrr_return_receive_details mrrd left join mrr_return_receive mrr on mrrd.mrr_rr_id=mrr.mrr_rr_id where mrrd.receive_date>="'.$opening_from_date.'" and mrrd.receive_date<="'.$opening_to_date.'" and mrrd.item_id='.$item.' and mrrd.brand_id='.$brand_id.' and mrrd.mrr_rr_d_status="received" and mrr.branch_id='.$branch_id;
                    $mrr_return_receive=$this->m_common->customeQuery($sql);

                    $total_receive_qty=$receive_qty[0]['re_qty']+$issue_return_qty[0]['is_ret_qty']+$mrr_return_receive[0]['mrr_receive_qty']+$adjustment_qty[0]['adjust_qty'];
                    $total_receive_value=$receive_qty[0]['re_value']+$issue_return_qty[0]['is_ret_value']+$mrr_return_receive[0]['mrr_receive_value']+$adjustment_qty[0]['adjust_value'];

                    $issue_qty=array();   
                    $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$opening_from_date.'" and consumption_date<="'.$opening_to_date.'" and item_id='.$item.' and brand_id='.$brand_id.' and status="Approved" and unit_id='.$branch_id;
                    $issue_qty=$this->m_common->customeQuery($sql);

                    $delivery_issue_qty=array();  
                    $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where issue_date>="'.$opening_from_date.'" and issue_date<="'.$opening_to_date.'" and item_id='.$item.' and brand_id='.$brand_id.' and issue_status="issued" and issue_type="delivey" ';
                    $delivery_issue_qty=$this->m_common->customeQuery($sql);


                    $return_qty=array();  
                    $sql='Select sum(rrd.return_qty) as ret_qty,sum(rrd.return_value) as ret_value from return_receive_details rrd left join return_receive rr on rrd.rr_id=rr.rr_id where rrd.rr_date>="'.$opening_from_date.'" and rrd.rr_date<="'.$opening_to_date.'" and rrd.item_id='.$item.' and rrd.brand_id='.$brand_id.' and rrd.rr_d_status="returned" and rr.branch_id='.$branch_id;
                    $return_qty=$this->m_common->customeQuery($sql);

                    $total_issue_qty=$issue_qty[0]['issue_qty']+$delivery_issue_qty[0]['issue_qty']+$return_qty[0]['ret_qty'];
                    $total_issue_value=$issue_qty[0]['issue_value']+$delivery_issue_qty[0]['issue_value']+$return_qty[0]['ret_value'];

                    $closing_qty=$total_receive_qty+$opeing_info[0]['total_opening_stock']-$total_issue_qty;
                    $closing_value=$total_receive_value+$opeing_info[0]['total_opening_value']-$total_issue_value;
                    $closing_rate=round($closing_value/$closing_qty,2);
               }
               
              
               
               for($i=$from_date;$i<=$too_date;$i=date('Y-m-d', strtotime('+1 day', strtotime($i))) ){
                   $opening_qty=$closing_qty;
                   $opening_value=$closing_value;
                   $current_rate=$closing_rate;
                   $details_info[$j]['date']=date('d-m-Y',strtotime($i));
                   $details_info[$j]['opening_balance']=$opening_qty;
                   $details_info[$j]['opening_value']=$opening_value;
                   $details_info[$j]['opening_rate']=$current_rate;
                   if(!empty($opening_qty)){
                       $details_info[$j]['opening_balance']=$opening_qty;
                   }else{
                      $details_info[$j]['opening_balance']='-'; 
                   }
                   if(!empty($opening_value)){
                      $details_info[$j]['opening_value']=$opening_value;
                   }else{
                      $details_info[$j]['opening_value']='-'; 
                   }
                   if(!empty($current_rate)){
                       $details_info[$j]['opening_rate']=$current_rate;
                   }else{
                      $details_info[$j]['opening_rate']='-'; 
                   }
                   
                   $receive_qty=array();
                   
                   if(empty($brand_id)){
                        $sql='Select sum(tmrrd.receive_qty) as re_qty,sum(tmrrd.amount) as re_value  from tbl_material_receive_requisition_details tmrrd left join material_receive_requisition mrr on tmrrd.mrr_id=mrr.mrr_id where tmrrd.receive_date="'.$i.'" and tmrrd.item_id='.$item.' and mrr.mrr_status="received" and mrr.unit_id='.$branch_id;
                        $receive_qty=$this->m_common->customeQuery($sql);
                   }else{
                        $sql='Select sum(tmrrd.receive_qty) as re_qty,sum(tmrrd.amount) as re_value  from tbl_material_receive_requisition_details tmrrd left join material_receive_requisition mrr on tmrrd.mrr_id=mrr.mrr_id where tmrrd.receive_date="'.$i.'" and tmrrd.item_id='.$item.' and tmrrd.brand_id='.$brand_id.' and mrr.mrr_status="received" and mrr.unit_id='.$branch_id;
                        $receive_qty=$this->m_common->customeQuery($sql);
                   }

                   $receive_rate=round($receive_qty[0]['re_value']/$receive_qty[0]['re_qty'],2);
                   if(!empty($receive_qty[0]['re_qty'])){
                    $details_info[$j]['receive_qty']=$receive_qty[0]['re_qty'];
                   }else{
                        $details_info[$j]['receive_qty']='-';
                   }
                   if(!empty($receive_qty[0]['re_value'])){
                    $details_info[$j]['receive_value']=$receive_qty[0]['re_value'];
                   }else{
                        $details_info[$j]['receive_value']='-';
                   }
                  if(!empty($receive_rate)){
                    $details_info[$j]['receive_rate']=$receive_rate;
                   }else{
                        $details_info[$j]['receive_rate']='-';
                   }
                  
                   $issue_return_qty=array();
                   if(empty($brand_id)){
                        $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date="'.$i.'" and item_id='.$item.' and ir_d_status="received" ';
                        $issue_return_qty=$this->m_common->customeQuery($sql);
                   }else{
                        $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date="'.$i.'" and item_id='.$item.' and brand_id='.$brand_id.' and ir_d_status="received" ';
                        $issue_return_qty=$this->m_common->customeQuery($sql);
                   }
                   
                   $details_info[$j]['issue_return_rate']=$issue_return_qty[0]['is_ret_value']/$issue_return_qty[0]['is_ret_qty'];
                   $return_issue_rate=round($issue_return_qty[0]['is_ret_value']/$issue_return_qty[0]['is_ret_qty'],2);
                   
                   if(!empty($issue_return_qty[0]['is_ret_qty'])){
                        $details_info[$j]['issue_return_qty']=$issue_return_qty[0]['is_ret_qty'];
                   }else{
                        $details_info[$j]['issue_return_qty']='-';
                   }
                   if(!empty($issue_return_qty[0]['is_ret_value'])){
                        $details_info[$j]['issue_return_value']=$issue_return_qty[0]['is_ret_value'];
                   }else{
                        $details_info[$j]['issue_return_value']='-';
                   }
                  if(!empty($return_issue_rate)){
                        $details_info[$j]['issue_return_rate']=$return_issue_rate;
                   }else{
                        $details_info[$j]['issue_return_rate']='-';
                   }
                   
                   
                   $mrr_return_receive=array();
                   if(empty($brand_id)){
                        $sql='Select sum(mrrd.receive_qty) as mrr_receive_qty,sum(mrrd.receive_value) as mrr_receive_value from mrr_return_receive_details mrrd left join mrr_return_receive mrr on mrrd.mrr_rr_id=mrr.mrr_rr_id  where mrrd.receive_date="'.$i.'" and mrrd.item_id='.$item.' and mrrd.mrr_rr_d_status="received" and mrr.branch_id='.$branch_id;
                        $mrr_return_receive=$this->m_common->customeQuery($sql);
                   }else{
                        $sql='Select sum(mrrd.receive_qty) as mrr_receive_qty,sum(mrrd.receive_value) as mrr_receive_value from mrr_return_receive_details mrrd left join mrr_return_receive mrr on mrrd.mrr_rr_id=mrr.mrr_rr_id  where mrrd.receive_date="'.$i.'" and mrrd.item_id='.$item.' and mrrd.brand_id='.$brand_id.' and mrrd.mrr_rr_d_status="received" and mrr.branch_id='.$branch_id;
                        $mrr_return_receive=$this->m_common->customeQuery($sql);
                   }
                   
                   $details_info[$j]['mrr_receive_rate']=$issue_return_qty[0]['mrr_receive_value']/$issue_return_qty[0]['mrr_receive_qty'];
                   $mrr_receive_rate=round($mrr_return_receive[0]['mrr_receive_value']/$mrr_return_receive[0]['mrr_receive_qty'],2);
                   
                   if(!empty($mrr_return_receive[0]['mrr_receive_qty'])){
                        $details_info[$j]['mrr_receive_qty']=$mrr_return_receive[0]['mrr_receive_qty'];
                   }else{
                        $details_info[$j]['mrr_receive_qty']='-';
                   }
                   if(!empty($mrr_return_receive[0]['mrr_receive_value'])){
                        $details_info[$j]['mrr_receive_value']=$mrr_return_receive[0]['mrr_receive_value'];
                   }else{
                        $details_info[$j]['mrr_receive_value']='-';
                   }
                   if(!empty($mrr_receive_rate)){
                        $details_info[$j]['mrr_receive_rate']=$mrr_receive_rate;
                   }else{
                        $details_info[$j]['mrr_receive_rate']='-';
                   }
                   
                   
                   $adjustment_qty=array();
                   if(empty($brand_id)){
                        $sql='Select sum(qty) as adjust_qty,sum(amount) as adjust_value from tbl_item_adjustment where date="'.$i.'" and item_id='.$item.' and is_active=1 and status="Confirmed" and unit_id='.$branch_id;
                        $adjustment_qty=$this->m_common->customeQuery($sql);
                   }else{
                        $sql='Select sum(qty) as adjust_qty,sum(amount) as adjust_value from tbl_item_adjustment where date="'.$i.'" and item_id='.$item.' and brand_id='.$brand_id.' and is_active=1 and status="Confirmed" and unit_id='.$branch_id;
                        $adjustment_qty=$this->m_common->customeQuery($sql);
                   }
                   if(!empty($adjustment_qty[0]['adjust_qty'])){
                        $details_info[$j]['adjust_qty']=$adjustment_qty[0]['adjust_qty'];
                        $details_info[$j]['adjust_value']=$adjustment_qty[0]['adjust_value'];
                        $details_info[$j]['adjust_rate']=$adjustment_qty[0]['adjust_value']/$adjustment_qty[0]['adjust_qty'];
                   }else{
                        $details_info[$j]['adjust_qty']='-';
                        $details_info[$j]['adjust_value']='-';
                        $details_info[$j]['adjust_rate']='-';
                   }
                   
                   
                   

                   $total_receive_qty=$receive_qty[0]['re_qty']+$issue_return_qty[0]['is_ret_qty']+$mrr_return_receive[0]['mrr_receive_qty']+$adjustment_qty[0]['adjust_qty'];
                   $total_receive_value=$receive_qty[0]['re_value']+$issue_return_qty[0]['is_ret_value']+$mrr_return_receive[0]['mrr_receive_value']+$adjustment_qty[0]['adjust_value'];
                   $avilable_quantity=$total_receive_qty+$opening_qty;
                   $avilable_value=$total_receive_value+$opening_value;
                   $avilable_rate=round($avilable_value/$avilable_quantity,2);
               
                   if(!empty($avilable_quantity)){
                        $details_info[$j]['total_rec_ret_qty']=$avilable_quantity;
                   }else{
                        $details_info[$j]['total_rec_ret_qty']='-';
                   }
                   if(!empty($avilable_value)){
                        $details_info[$j]['total_rec_ret_value']=$avilable_value;
                   }else{
                        $details_info[$j]['total_rec_ret_value']='-';
                   }
                  if(!empty($avilable_rate)){
                        $details_info[$j]['total_rec_ret_rate']=$avilable_rate;
                   }else{
                        $details_info[$j]['total_rec_ret_rate']='-';
                   }
                   $issue_qty=array();
                   
                   if(empty($brand_id)){
                        $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date="'.$i.'" and item_id='.$item.' and status="Approved" and unit_id='.$branch_id;
                        $issue_qty=$this->m_common->customeQuery($sql);
                   }else{
                        $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date="'.$i.'" and item_id='.$item.' and brand_id='.$brand_id.' and status="Approved" and unit_id='.$branch_id;
                        $issue_qty=$this->m_common->customeQuery($sql);
                   }
                   
                   $details_info[$j]['issue_rate']=$issue_qty[0]['issue_value']/$issue_qty[0]['issue_qty'];
                   $issue_rate=round($issue_qty[0]['issue_value']/$issue_qty[0]['issue_qty'],2);
                   if(!empty($issue_qty[0]['issue_qty'])){
                        $details_info[$j]['issue_qty']=$issue_qty[0]['issue_qty'];
                   }else{
                        $details_info[$j]['issue_qty']='-';
                   }
                   if(!empty($issue_qty[0]['issue_value'])){
                        $details_info[$j]['issue_value']=$issue_qty[0]['issue_value'];
                   }else{
                        $details_info[$j]['issue_value']='-';
                   }
                  if(!empty($issue_rate)){
                        $details_info[$j]['issue_rate']=$issue_rate;
                   }else{
                        $details_info[$j]['issue_rate']='-';
                   }
                   $delivery_issue_qty=array();
                   if(empty($brand_id)){
                        $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where issue_date="'.$i.'" and item_id='.$item.' and issue_status="issued" and issue_type="delivey" ';
                        $delivery_issue_qty=$this->m_common->customeQuery($sql);
                   }else{
                        $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where issue_date="'.$i.'" and item_id='.$item.' and brand_id='.$brand_id.' and issue_status="issued" and issue_type="delivey" ';
                        $delivery_issue_qty=$this->m_common->customeQuery($sql);
                   }
                   
                   $details_info[$j]['delivery_rate']=$delivery_issue_qty[0]['issue_value']/$delivery_issue_qty[0]['issue_qty'];
                   $delivery_rate=round($delivery_issue_qty[0]['issue_value']/$delivery_issue_qty[0]['issue_qty'],2);
                   if(!empty($delivery_issue_qty[0]['issue_qty'])){
                        $details_info[$j]['delivery_qty']=$delivery_issue_qty[0]['issue_qty'];
                   }else{
                        $details_info[$j]['delivery_qty']='-';
                   }
                   if(!empty($delivery_issue_qty[0]['issue_value'])){
                        $details_info[$j]['delivery_value']=$delivery_issue_qty[0]['issue_value'];
                   }else{
                        $details_info[$j]['delivery_value']='-';
                   }
                   if(!empty($delivery_rate)){
                        $details_info[$j]['delivery_rate']=$delivery_rate;
                   }else{
                        $details_info[$j]['delivery_rate']='-';
                   }
                   $return_qty=array();
                   if(empty($brand_id)){
                        $sql='Select sum(rrd.return_qty) as ret_qty,sum(rrd.return_value) as ret_value from return_receive_details rrd left join return_receive rr on rrd.rr_id=rr.rr_id where rrd.rr_date="'.$i.'" and rrd.item_id='.$item.' and rrd.rr_d_status="returned" and rr.branch_id='.$branch_id;
                        $return_qty=$this->m_common->customeQuery($sql);
                   }else{
                        $sql='Select sum(rrd.return_qty) as ret_qty,sum(rrd.return_value) as ret_value from return_receive_details rrd left join return_receive rr on rrd.rr_id=rr.rr_id where rrd.rr_date="'.$i.'" and rrd.item_id='.$item.' and rrd.brand_id='.$brand_id.' and rrd.rr_d_status="returned" and rr.branch_id='.$branch_id;
                        $return_qty=$this->m_common->customeQuery($sql);
                   }
                   
                   $details_info[$j]['return_rate']=$return_qty[0]['ret_value']/$return_qty[0]['ret_qty'];
                   $return_rate=round($return_qty[0]['ret_value']/$return_qty[0]['ret_qty'],2);
                   if(!empty($return_qty[0]['return_qty'])){
                        $details_info[$j]['return_qty']=$return_qty[0]['return_qty'];
                   }else{
                        $details_info[$j]['return_qty']='-';
                   }
                   if(!empty($return_qty[0]['return_value'])){
                        $details_info[$j]['return_value']=$return_qty[0]['return_value'];
                   }else{
                        $details_info[$j]['return_value']='-';
                   }
                  if(!empty($return_rate)){
                        $details_info[$j]['return_rate']=$return_rate;
                   }else{
                        $details_info[$j]['return_rate']='-';
                   }

                   $total_issue_qty=$issue_qty[0]['issue_qty']+$delivery_issue_qty[0]['issue_qty']+$return_qty[0]['ret_qty'];
                   $total_issue_value=$issue_qty[0]['issue_value']+$delivery_issue_qty[0]['issue_value']+$return_qty[0]['ret_value'];
                   $total_issue_rate=round($total_issue_value/$total_issue_qty,2);
                   
                   $details_info[$j]['total_issue_rate']= $total_issue_value/$total_issue_qty;
                   if(!empty($total_issue_qty)){
                        $details_info[$j]['total_issue_qty']=$total_issue_qty;
                   }else{
                        $details_info[$j]['total_issue_qty']='-';
                   }
                   if(!empty($total_issue_value)){
                        $details_info[$j]['total_issue_value']=$total_issue_value;
                   }else{
                        $details_info[$j]['total_issue_value']='-';
                   }
                  if(!empty($total_issue_rate)){
                        $details_info[$j]['total_issue_rate']=$total_issue_rate;
                   }else{
                        $details_info[$j]['total_issue_rate']='-';
                   }
                    
                  $closing_qty=$total_receive_qty+$opening_qty-$total_issue_qty;
                  $closing_value=$total_receive_value+$opening_value-$total_issue_value;
                  $closing_rate=round($closing_value/$closing_qty,2);
                  
                  $details_info[$j]['closing_balance']=$closing_qty;
                  $details_info[$j]['closing_value']=$closing_value;
                  $details_info[$j]['closing_rate']=$closing_rate;
                   if(!empty($closing_qty)){
                        $details_info[$j]['closing_balance']=$closing_qty;
                   }else{
                        $details_info[$j]['closing_balance']='-';
                   }
                   if(!empty($closing_value)){
                        $details_info[$j]['closing_value']=$closing_value;
                   }else{
                        $details_info[$j]['closing_value']='-';
                   }
                  if(!empty($closing_rate)){
                        $details_info[$j]['closing_rate']=$closing_rate;
                   }else{
                        $details_info[$j]['closing_rate']='-';
                   }
                   
                  if($j >0 && $details_info[$j]['receive_qty']=='-' && $details_info[$j]['issue_return_qty']=='-' && $details_info[$j]['mrr_receive_qty']=='-' && $details_info[$j]['issue_qty']=='-' && $details_info[$j]['delivery_qty']=='-'&& $details_info[$j]['return_qty']=='-'  ){
                      unset($details_info[$j]);
                  } 
                  
                  $j++;
               }
               $data['data']=$details_info;
           }

         
               
          
        }else{
           $item='';
           $f_date='';
           $to_date='';
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['brands']='';
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*'); 
        }
       // $this->load->view('report/store_ledger',$data);
         if($print==false){
             $this->load->view('report/bincart',$data);
        }else{
           $html=$this->load->view('report/print_bincart', $data,true);
           echo $html;exit; 
        }
        
    }
    
    
    
    function receiveReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        
        $postData = $this->input->post();
        $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
        if(!empty($postData)){
            
          $report_type=$this->input->post('report_type');  
          $report_format=$this->input->post('report_format'); 
            
           $item=$this->input->post('item');
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $from_date=date('Y-m-d',strtotime($f_date));
           $too_date=date('Y-m-d',strtotime($to_date));
           $data['report_type']=$report_type;
           $data['report_format']=$report_format;
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
          
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
           if($report_format=="general"){
                    if($report_type=="summary"){
                         if($item=="all"){
                            $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                         }else{
                             $data['items']=$this->m_common->get_row_array('items',array('id'=>$item),'*'); 
                         }

                          foreach($data['items'] as $key=>$item_info){
                              $sql='Select sum(receive_qty) as re_qty,sum(total_cost) as re_value from material_receive_requisition_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and item_id='.$item_info['id'].' and mrr_d_status="received" ';
                              $receive_qty=$this->m_common->customeQuery($sql);
                              if(!empty($receive_qty[0]['re_qty'])){
                                   $data['items'][$key]['receive_qty']=$receive_qty[0]['re_qty'];
                                   $data['items'][$key]['receive_value']=$receive_qty[0]['re_value'];
                              }else{
                                  $data['items'][$key]['receive_qty']=0; 
                                  $data['items'][$key]['receive_value']=0;
                              }


                          }

                           $data['data']=$data['items'];
                    }else{
                        if($item=="all"){
                           $sql='Select * from material_receive_requisition_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and mrr_d_status="received" order by receive_date ';
                        }else{
                           $sql='Select * from material_receive_requisition_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and item_id='.$item.' and mrr_d_status="received" ';
                        }
                        $receive_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$receive_qty;

                    }         
           }else if($report_format=="project"){
                $item=$this->input->post('item');
                $data['departments']=$this->m_common->get_row_array('department','','*');
                 if($report_type=="summary"){
                       
                          $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                        

                          foreach($data['items'] as $key=>$item_info){
                              $sql='Select sum(receive_qty) as re_qty,sum(total_cost) as re_value from material_receive_requisition_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and item_id='.$item_info['id'].' and department_id='.$item.' and mrr_d_status="received" ';
                              $receive_qty=$this->m_common->customeQuery($sql);
                              if(!empty($receive_qty[0]['re_qty'])){
                                   $data['items'][$key]['receive_qty']=$receive_qty[0]['re_qty'];
                                   $data['items'][$key]['receive_value']=$receive_qty[0]['re_value'];
                              }else{
                                  $data['items'][$key]['receive_qty']=0; 
                                  $data['items'][$key]['receive_value']=0;
                                  unset($data['items'][$key]);
                              }


                          }

                           $data['data']=$data['items'];
                    }else{
                      
                           $sql='Select * from material_receive_requisition_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and department_id='.$item.' and mrr_d_status="received" order by receive_date ';
                       
                        $receive_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$receive_qty;

                    }         
           }else if($report_format=="assets"){
                $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Asset"),'*','','','item_name');
                $item=$this->input->post('item');
                 if($report_type=="summary"){
                       
                          $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                        

                          foreach($data['items'] as $key=>$item_info){
                              $sql='Select sum(receive_qty) as re_qty,sum(total_cost) as re_value from material_receive_requisition_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and item_id='.$item_info['id'].' and asset_id='.$item.' and mrr_d_status="received" ';
                              $receive_qty=$this->m_common->customeQuery($sql);
                              if(!empty($receive_qty[0]['re_qty'])){
                                   $data['items'][$key]['receive_qty']=$receive_qty[0]['re_qty'];
                                   $data['items'][$key]['receive_value']=$receive_qty[0]['re_value'];
                              }else{
                                  $data['items'][$key]['receive_qty']=0; 
                                  $data['items'][$key]['receive_value']=0;
                                  unset($data['items'][$key]);
                              }


                          }

                           $data['data']=$data['items'];
                    }else{
                      
                        $sql='Select * from material_receive_requisition_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and asset_id='.$item.' and mrr_d_status="received" ';         
                        $receive_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$receive_qty;

                    }         
           }else if($report_format=="mrr"){
                $sql='select * from v_material_receive_requisition where mrr_date>="'.$from_date.'" and mrr_date<="'.$too_date.' " and mrr_status="received" ';
                $data['all_mrr_info']=$this->m_common->customeQuery($sql);
                 foreach($data['all_mrr_info'] as $key=>$mrr_info){
                     $data['all_mrr_info'][$key]['mrr_items']=$this->m_common->get_row_array('v_material_receive_requistion_details',array('mrr_id'=>$mrr_info['mrr_id']),'*'); 
                 }
                $data['data']=$data['all_mrr_info'];
//                 echo "<pre>";
//                 print_r( $data['all_mrr_info']);
//                 echo "</pre>";
//                 exit;
               
           }else{
                $supplier_id=$this->input->post('supplier');
                $data['sup_id']=$supplier_id;
                if($supplier_id=="all"){
                    $sql='select * from v_material_receive_requisition where mrr_date>="'.$from_date.'" and mrr_date<="'.$too_date.' " and mrr_status="received" ';
                }else{
                    $sql='select * from v_material_receive_requisition where mrr_date>="'.$from_date.'" and mrr_date<="'.$too_date.' " and mrr_status="received" and mrr_supplier_id='.$supplier_id;
                }
                $data['all_mrr_info']=$this->m_common->customeQuery($sql);
                 foreach($data['all_mrr_info'] as $key=>$mrr_info){
                     $data['all_mrr_info'][$key]['mrr_items']=$this->m_common->get_row_array('v_material_receive_requistion_details',array('mrr_id'=>$mrr_info['mrr_id']),'*'); 
                 }
                $data['data']=$data['all_mrr_info'];
           }
        }else{
           $item='';
           $f_date='';
           $to_date='';
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name'); 
        }
       // $this->load->view('report/receive_report',$data);
        if($print==false){
             $this->load->view('report/receive_report',$data);
        }else{
           $html=$this->load->view('report/print_receive_report', $data,true);
           echo $html;exit; 
        }
        
    }
    
    
    
    
     function issueReturnReceiveReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        
        $postData = $this->input->post();
        if(!empty($postData)){
            
           $report_type=$this->input->post('report_type');  
           $report_format=$this->input->post('report_format'); 
            
           $item=$this->input->post('item');
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $from_date=date('Y-m-d',strtotime($f_date));
           $too_date=date('Y-m-d',strtotime($to_date));
           $data['report_type']=$report_type;
           $data['report_format']=$report_format;
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
            if($report_format=="general"){
                        if($report_type=="summary"){
                             if($item=="all"){
                                $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                             }else{
                                 $data['items']=$this->m_common->get_row_array('items',array('id'=>$item),'*'); 
                             }

                              foreach($data['items'] as $key=>$item_info){
                                 $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date>="'.$from_date.'" and ir_date<="'.$too_date.'" and item_id='.$item_info['id'].' and ir_d_status="received" ';
                                 $issue_return_qty=$this->m_common->customeQuery($sql);
                                 if(!empty($issue_return_qty[0]['is_ret_qty'])){
                                      $data['items'][$key]['issue_return_qty']=$issue_return_qty[0]['is_ret_qty'];
                                      $data['items'][$key]['issue_return_value']=$issue_return_qty[0]['is_ret_value'];
                                 }else{
                                     $data['items'][$key]['issue_return_qty']=0;
                                     $data['items'][$key]['issue_return_value']=0;
                                 }


                              }

                               $data['data']=$data['items'];
                        }else{
                            if($item=="all"){
                                $sql='Select * from issue_return_details where ir_date>="'.$from_date.'" and ir_date<="'.$too_date.'" and ir_d_status="received" order by ir_date ';
                            }else{
                                $sql='Select * from issue_return_details where ir_date>="'.$from_date.'" and ir_date<="'.$too_date.'" and item_id='.$item.' and ir_d_status="received" ';
                            }
                            $receive_qty=$this->m_common->customeQuery($sql);
                            $data['data']=$receive_qty;

                        }         
            }else if($report_format=="project"){
                $item=$this->input->post('item');
                $data['departments']=$this->m_common->get_row_array('department','','*');
                 if($report_type=="summary"){
                       
                          $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                        

                          foreach($data['items'] as $key=>$item_info){
                              
                                $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date>="'.$from_date.'" and ir_date<="'.$too_date.'" and item_id='.$item_info['id'].' and department_id='.$item.' and ir_d_status="received" ';
                                $issue_return_qty=$this->m_common->customeQuery($sql);
                                if(!empty($issue_return_qty[0]['is_ret_qty'])){
                                     $data['items'][$key]['issue_return_qty']=$issue_return_qty[0]['is_ret_qty'];
                                     $data['items'][$key]['issue_return_value']=$issue_return_qty[0]['is_ret_value'];
                                }else{
                                    $data['items'][$key]['issue_return_qty']=0;
                                    $data['items'][$key]['issue_return_value']=0;
                                   unset($data['items'][$key]);
                                }
                             


                          }

                           $data['data']=$data['items'];
                    }else{
                           $sql='Select * from issue_return_details where ir_date>="'.$from_date.'" and ir_date<="'.$too_date.'" and department_id='.$item.' and ir_d_status="received" order by ir_date ';  
                          
                       
                        $receive_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$receive_qty;

                    }         
           }else{
                $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Asset"),'*','','','item_name');
                $item=$this->input->post('item');
                 if($report_type=="summary"){
                       
                          $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                        

                          foreach($data['items'] as $key=>$item_info){
                              $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date>="'.$from_date.'" and ir_date<="'.$too_date.'" and item_id='.$item_info['id'].' and asset_id='.$item.' and ir_d_status="received" ';
                                $issue_return_qty=$this->m_common->customeQuery($sql);
                                if(!empty($issue_return_qty[0]['is_ret_qty'])){
                                     $data['items'][$key]['issue_return_qty']=$issue_return_qty[0]['is_ret_qty'];
                                     $data['items'][$key]['issue_return_value']=$issue_return_qty[0]['is_ret_value'];
                                }else{
                                    $data['items'][$key]['issue_return_qty']=0;
                                    $data['items'][$key]['issue_return_value']=0;
                                   unset($data['items'][$key]);
                                }

                          }

                           $data['data']=$data['items'];
                    }else{
                      
                        $sql='Select * from issue_return_details where ir_date>="'.$from_date.'" and ir_date<="'.$too_date.'" and asset_id='.$item.' and ir_d_status="received" order by ir_date ';              
                        $receive_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$receive_qty;

                    }         
           }
          
          
          
          
        }else{
           $item='';
           $f_date='';
           $to_date='';
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name'); 
        }
       // $this->load->view('report/issue_return_receive_report',$data);
         if($print==false){
             $this->load->view('report/issue_return_receive_report',$data);
        }else{
           $html=$this->load->view('report/print_issue_return_receive', $data,true);
           echo $html;exit; 
        }
    }
    
    
     function mrrReturnReceiveReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        
        $postData = $this->input->post();
        if(!empty($postData)){
            
          $report_type=$this->input->post('report_type');  
          $report_format=$this->input->post('report_format'); 
            
           $item=$this->input->post('item');
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $from_date=date('Y-m-d',strtotime($f_date));
           $too_date=date('Y-m-d',strtotime($to_date));
           $data['report_type']=$report_type;
           $data['report_format']=$report_format;
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
             if($report_format=="general"){
                    if($report_type=="summary"){
                         if($item=="all"){
                            $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                         }else{
                             $data['items']=$this->m_common->get_row_array('items',array('id'=>$item),'*'); 
                         }

                          foreach($data['items'] as $key=>$item_info){
                             $sql='Select sum(receive_qty) as mrr_receive_qty,sum(receive_value) as mrr_receive_value from mrr_return_receive_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and item_id='.$item_info['id'].' and mrr_rr_d_status="received" ';
                             $issue_return_qty=$this->m_common->customeQuery($sql);
                             if(!empty($issue_return_qty[0]['mrr_receive_qty'])){
                                  $data['items'][$key]['mrr_receive_qty']=$issue_return_qty[0]['mrr_receive_qty'];
                                  $data['items'][$key]['mrr_receive_value']=$issue_return_qty[0]['mrr_receive_value'];
                             }else{
                                 $data['items'][$key]['mrr_receive_qty']=0;
                                 $data['items'][$key]['mrr_receive_value']=0;
                                 
                             }


                          }

                           $data['data']=$data['items'];
                    }else{
                        if($item=="all"){
                             $sql='Select * from mrr_return_receive_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and mrr_rr_d_status="received" order by receive_date ';
                        }else{
                            $sql='Select * from mrr_return_receive_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and item_id='.$item.' and mrr_rr_d_status="received" ';
                        }
                        $receive_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$receive_qty;

                    }         
             }else if($report_format=="project"){
                $item=$this->input->post('item');
                $data['departments']=$this->m_common->get_row_array('department','','*');
                 if($report_type=="summary"){
                       
                          $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                        

                          foreach($data['items'] as $key=>$item_info){
                                $sql='Select sum(receive_qty) as mrr_receive_qty,sum(receive_value) as mrr_receive_value from mrr_return_receive_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and item_id='.$item_info['id'].' and department_id='.$item.' and mrr_rr_d_status="received" ';
                                $issue_return_qty=$this->m_common->customeQuery($sql);
                                if(!empty($issue_return_qty[0]['mrr_receive_qty'])){
                                     $data['items'][$key]['mrr_receive_qty']=$issue_return_qty[0]['mrr_receive_qty'];
                                     $data['items'][$key]['mrr_receive_value']=$issue_return_qty[0]['mrr_receive_value'];
                                }else{
                                    $data['items'][$key]['mrr_receive_qty']=0;
                                    $data['items'][$key]['mrr_receive_value']=0;
                                    unset($data['items'][$key]);
                                }
                              
                              
                             


                          }

                           $data['data']=$data['items'];
                    }else{
                        
                        $sql='Select * from mrr_return_receive_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and department_id='.$item.' and mrr_rr_d_status="received" order by receive_date ';
                             
                        $receive_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$receive_qty;

                    }         
           }else{
                $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Asset"),'*','','','item_name');
                $item=$this->input->post('item');
                 if($report_type=="summary"){
                       
                          $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                        

                          foreach($data['items'] as $key=>$item_info){
                              $sql='Select sum(receive_qty) as mrr_receive_qty,sum(receive_value) as mrr_receive_value from mrr_return_receive_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and item_id='.$item_info['id'].' and asset_id='.$item.' and mrr_rr_d_status="received" ';
                                $issue_return_qty=$this->m_common->customeQuery($sql);
                                if(!empty($issue_return_qty[0]['mrr_receive_qty'])){
                                     $data['items'][$key]['mrr_receive_qty']=$issue_return_qty[0]['mrr_receive_qty'];
                                     $data['items'][$key]['mrr_receive_value']=$issue_return_qty[0]['mrr_receive_value'];
                                }else{
                                    $data['items'][$key]['mrr_receive_qty']=0;
                                    $data['items'][$key]['mrr_receive_value']=0;
                                    unset($data['items'][$key]);
                                }
                          }

                           $data['data']=$data['items'];
                    }else{
                      
                        $sql='Select * from mrr_return_receive_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and asset_id='.$item.' and mrr_rr_d_status="received" order by receive_date ';     
                        $receive_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$receive_qty;

                    }         
           }
             
             
        }else{
           $item='';
           $f_date='';
           $to_date='';
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name'); 
        }
         if($print==false){
             $this->load->view('report/mrr_return_receive_report',$data);
        }else{
           $html=$this->load->view('report/print_mrr_return_receive', $data,true);
           echo $html;exit; 
        }
      //  $this->load->view('report/mrr_return_receive_report',$data);
    }
    
    
      function issueReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $branch_id= $this->session->userdata('companyId');
        $data['branch_info']=$this->m_common->get_row_array('department',array('d_id'=>$branch_id),'*');
        $postData = $this->input->post();
        if(!empty($postData)){
            
           $report_type=$this->input->post('report_type');  
           $report_format=$this->input->post('report_format'); 
            
           $item=$this->input->post('item');
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $from_date=date('Y-m-d',strtotime($f_date));
           $too_date=date('Y-m-d',strtotime($to_date));
           $data['report_type']=$report_type;
           $data['report_format']=$report_format;
           $data['item_id']=$item;
           $brand_id=$this->input->post('brand_id');
           if(!empty($brand_id)){
              $data['brand_id']=$brand_id; 
           }else{
              $data['brand_id']=''; 
           }
           
           $c_c_id=$this->input->post('c_c_id');
           $data['c_c_id']=$c_c_id;
           $data['cost_center_info'] = $this->m_common->get_row_array('cost_center',array('c_c_id'=>$c_c_id), '*');
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
           
           $consumption_items=array();
           
           if($report_format=="general"){
                    if($report_type=="summary"){
                         if($item=="all"){
                           // $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                           //  $data['items']=$this->m_common->get_row_array('items','','*','','','item_name');
                             $sql="select i.*,tmu.meas_unit from items i left join tbl_measurement_unit tmu on i.mu_id=tmu.id";
                             $data['items']=$this->m_common->customeQuery($sql);
                         }else{
                             //$data['items']=$this->m_common->get_row_array('items',array('id'=>$item),'*'); 
                             $sql="select i.*,tmu.meas_unit from items i left join tbl_measurement_unit tmu on i.mu_id=tmu.id where i.id=".$item;
                             $data['items']=$this->m_common->customeQuery($sql);
                         }

                          foreach($data['items'] as $key=>$item_info){
                             $issue_qty=array();
                             if(!empty($c_c_id)){
                                $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$from_date.'" and consumption_date<="'.$too_date.'" and item_id='.$item_info['id'].' and status="Approved" and unit_id='.$branch_id.' and c_c_id='.$c_c_id;
                             }else{
                                $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$from_date.'" and consumption_date<="'.$too_date.'" and item_id='.$item_info['id'].' and status="Approved" and unit_id='.$branch_id; 
                             }
                             $issue_qty=$this->m_common->customeQuery($sql);
                             if(!empty($issue_qty[0]['issue_qty'])){
                                  $data['items'][$key]['issue_qty']=$issue_qty[0]['issue_qty'];
                                  $data['items'][$key]['issue_value']=$issue_qty[0]['issue_value'];
                             }else{
                                 $data['items'][$key]['issue_qty']=0; 
                                 $data['items'][$key]['issue_value']=0;
                                 unset($data['items'][$key]);
                             }


                          }

                           $data['data']=$data['items'];
                    }else{
                        if($item=="all"){
                            if(!empty($c_c_id)){
                                $sql='Select tic.*,i.item_name,tmu.meas_unit from tbl_item_comsumption tic left join items i on tic.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where tic.consumption_date>="'.$from_date.'" and tic.consumption_date<="'.$too_date.'" and tic.status="Approved" and tic.unit_id='.$branch_id.' and c_c_id='.$c_c_id.' order by tic.consumption_date ';
                            }else{
                                $sql='Select tic.*,i.item_name,tmu.meas_unit from tbl_item_comsumption tic left join items i on tic.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where tic.consumption_date>="'.$from_date.'" and tic.consumption_date<="'.$too_date.'" and tic.status="Approved" and tic.unit_id='.$branch_id.' order by tic.consumption_date ';
                            }    
                        }else{
                            $item_info=$this->m_common->get_row_array('items',array('id'=>$item),'*');
                            $brands= $this->m_common->get_row_array('tbl_item_brand',array('is_active'=>1), '*');
                            $item_brands=unserialize($item_info[0]['brand_id']);
                            $b=array();
                            foreach($brands as $key1=>$brand){
                                    if(!empty($item_brands)){  
                                        if(in_array($brand['id'],$item_brands)){
                                          $b[]=$brand;
                                        }else{
                                             unset($brands[$key1]);
                                        }
                                    }else{
                                        $b='';
                                    }
                            }        
                            $data['brands']=$b;   
                            
                         if(!empty($brand_id)){   
                            if(!empty($c_c_id)){  
                              $sql='Select tic.*,i.item_name,tmu.meas_unit from tbl_item_comsumption tic left join items i on tic.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where tic.consumption_date>="'.$from_date.'" and tic.consumption_date<="'.$too_date.'" and tic.item_id='.$item.' and tic.status="Approved" and tic.unit_id='.$branch_id.' and c_c_id='.$c_c_id.' and tic.brand_id='.$brand_id;
                            }else{
                              $sql='Select tic.*,i.item_name,tmu.meas_unit from tbl_item_comsumption tic left join items i on tic.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where tic.consumption_date>="'.$from_date.'" and tic.consumption_date<="'.$too_date.'" and tic.item_id='.$item.' and tic.status="Approved" and tic.unit_id='.$branch_id.' and tic.brand_id='.$brand_id;
                            }  
                         }else{
                            if(!empty($c_c_id)){  
                              $sql='Select tic.*,i.item_name,tmu.meas_unit from tbl_item_comsumption tic left join items i on tic.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where tic.consumption_date>="'.$from_date.'" and tic.consumption_date<="'.$too_date.'" and tic.item_id='.$item.' and tic.status="Approved" and tic.unit_id='.$branch_id.' and c_c_id='.$c_c_id;
                            }else{
                              $sql='Select tic.*,i.item_name,tmu.meas_unit from tbl_item_comsumption tic left join items i on tic.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where tic.consumption_date>="'.$from_date.'" and tic.consumption_date<="'.$too_date.'" and tic.item_id='.$item.' and tic.status="Approved" and tic.unit_id='.$branch_id;  
                            }  
                         }   
                        }
                        $issued_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$issued_qty;

                    }         
           }else if($report_format=="project"){
                $item=$this->input->post('item');
                $data['departments']=$this->m_common->get_row_array('department','','*');
                 if($report_type=="summary"){
                       
                          $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                        

                          foreach($data['items'] as $key=>$item_info){
                              
                             $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$from_date.'" and consumption_date<="'.$too_date.'" and item_id='.$item_info['id'].' and department_id='.$item.' and status="Approved" ';
                             $issue_qty=$this->m_common->customeQuery($sql);
                             if(!empty($issue_qty[0]['issue_qty'])){
                                  $data['items'][$key]['issue_qty']=$issue_qty[0]['issue_qty'];
                                  $data['items'][$key]['issue_value']=$issue_qty[0]['issue_value'];
                             }else{
                                 $data['items'][$key]['issue_qty']=0; 
                                 $data['items'][$key]['issue_value']=0;
                                 unset($data['items'][$key]);
                             }
                               
                              
                              
                             


                         }

                           $data['data']=$data['items'];
                    }else{
                        $sql='Select * from tbl_item_comsumption where consumption_date>="'.$from_date.'" and consumption_date<="'.$too_date.'" and department_id='.$item.' and status="Approved" order by consumption_date ';
                        
                        $receive_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$receive_qty;

                    }         
           }else{
                $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Asset"),'*','','','item_name');
                $item=$this->input->post('item');
                 if($report_type=="summary"){
                       
                          $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                        

                          foreach($data['items'] as $key=>$item_info){
                             $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$from_date.'" and consumption_date<="'.$too_date.'" and item_id='.$item_info['id'].' and asset_id='.$item.' and status="Approved" and unit_id='.$branch_id;
                             $issue_qty=$this->m_common->customeQuery($sql);
                             if(!empty($issue_qty[0]['issue_qty'])){
                                  $data['items'][$key]['issue_qty']=$issue_qty[0]['issue_qty'];
                                  $data['items'][$key]['issue_value']=$issue_qty[0]['issue_value'];
                             }else{
                                 $data['items'][$key]['issue_qty']=0; 
                                 $data['items'][$key]['issue_value']=0;
                                 unset($data['items'][$key]);
                             }
                          }

                           $data['data']=$data['items'];
                    }else{
                      
                       $sql='Select * from issue_session_details where issue_date>="'.$from_date.'" and issue_date<="'.$too_date.'" and asset_id='.$item.' and issue_status="issued" order by issue_date ';
                        
                        $receive_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$receive_qty;

                    }         
           }
           
           
           
        }else{
           $item='';
           $f_date='';
           $to_date='';
           $data['c_c_id']='';
           $data['item_id']=$item;
           $data['brand_id']='';
           $data['brands']='';
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name'); 
        }
       // $this->load->view('report/issue_report',$data);
        $data['cost_centers'] = $this->m_common->get_row_array('cost_center', '', '*');
         if($print==false){
             $this->load->view('report/issue_report',$data);
        }else{
           $html=$this->load->view('report/print_issue_report', $data,true);
           echo $html;exit; 
        }
    }
    
    
     function consumptionComparisonReport(){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $branch_id= $this->session->userdata('companyId');
        $data['branch_info']=$this->m_common->get_row_array('department',array('d_id'=>$branch_id),'*');
        $postData = $this->input->post();
        if(!empty($postData)){
            
           $report_type=$this->input->post('report_type');  
           $report_format=$this->input->post('report_format'); 
            
           $item=$this->input->post('item');
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $from_date=date('Y-m-d',strtotime($f_date));
           $too_date=date('Y-m-d',strtotime($to_date));
           $data['report_type']=$report_type;
           $data['report_format']=$report_format;
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
           if($report_format=="general"){
                    if($report_type=="summary"){
                         if($item=="all"){
                           // $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                           //  $data['items']=$this->m_common->get_row_array('items','','*','','','item_name');
                             $sql="select i.*,tmu.meas_unit from items i left join tbl_measurement_unit tmu on i.mu_id=tmu.id";
                             $data['items']=$this->m_common->customeQuery($sql);
                         }else{
                             //$data['items']=$this->m_common->get_row_array('items',array('id'=>$item),'*'); 
                             $sql="select i.*,tmu.meas_unit from items i left join tbl_measurement_unit tmu on i.mu_id=tmu.id where i.id=".$item;
                             $data['items']=$this->m_common->customeQuery($sql);
                         }

                          foreach($data['items'] as $key=>$item_info){
                             $issue_qty=array();
                             $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$from_date.'" and consumption_date<="'.$too_date.'" and item_id='.$item_info['id'].' and status="Approved" and unit_id='.$branch_id;
                             $issue_qty=$this->m_common->customeQuery($sql);
                             if(!empty($issue_qty[0]['issue_qty'])){
                                    $data['items'][$key]['issue_qty']=$issue_qty[0]['issue_qty'];
                                    
                                    $mixing_qty=array();
                                    $msql='Select sum(total_qty) as mixing_qty from tbl_production_mixing_details tpmd left join tbl_production_mixing tpm on tpmd.pm_id=tpm.pm_id  where tpm.created_date>="'.$from_date.'" and tpm.created_date<="'.$too_date.'" and tpmd.item_id='.$item_info['id'].' and tpm.status="Approved" and branch_id='.$branch_id;
                                    $mixing_qty=$this->m_common->customeQuery($msql);
                                    if(!empty($mixing_qty[0]['mixing_qty'])){
                                         $data['items'][$key]['mixing_qty']=$issue_qty[0]['mixing_qty'];

                                    }else{
                                        $data['items'][$key]['mixing_qty']=0; 

                                    }
                                  
                                  
                             }else{
                                 $data['items'][$key]['issue_qty']=0; 
                                 $data['items'][$key]['issue_value']=0;
                                 unset($data['items'][$key]);
                             }

                             
                             
                             
                             

                          }

                           $data['data']=$data['items'];
                    }else{
                        if($item=="all"){
                           $sql='Select tic.*,i.item_name,tmu.meas_unit from tbl_item_comsumption tic left join items i on tic.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where tic.consumption_date>="'.$from_date.'" and tic.consumption_date<="'.$too_date.'" and tic.status="Approved" and tic.unit_id='.$branch_id.' order by tic.consumption_date ';
                        }else{
                            $sql='Select tic.*,i.item_name,tmu.meas_unit from tbl_item_comsumption tic left join items i on tic.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where tic.consumption_date>="'.$from_date.'" and tic.consumption_date<="'.$too_date.'" and tic.item_id='.$item.' and tic.status="Approved" and tic.unit_id='.$branch_id;
                        }
                        $issued_qty=$this->m_common->customeQuery($sql);
                        foreach($issued_qty as $key=>$issue){
                            $mixing_qty=array();
                            $msql='Select sum(total_qty) as mixing_qty from tbl_production_mixing_details tpmd left join tbl_production_mixing tpm on tpmd.pm_id=tpm.pm_id  where tpm.created_date="'.$issue['consumption_date'].'" and tpmd.item_id='.$issue['item_id'].' and tpm.status="Approved" and branch_id='.$branch_id;
                            $mixing_qty=$this->m_common->customeQuery($msql);
                            if(!empty($mixing_qty[0]['mixing_qty'])){
                                    $issued_qty[$key]['mixing_qty']=$issue_qty[0]['mixing_qty'];

                           }else{
                                   $issued_qty[$key]['mixing_qty']=0; 

                            }
                            
                        }
                        $data['data']=$issued_qty;

                    }         
           }
           
        }else{
           $item='';
           $f_date='';
           $to_date='';
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name'); 
        }
       // $this->load->view('report/issue_report',$data);
        if($print==false){
             $this->load->view('report/consumption_comparison_report',$data);
        }else{
           $html=$this->load->view('report/print_consumption_comparison_report', $data,true);
           echo $html;exit; 
        }
    }
    
    
    
    function adjustmentReport($print=false){
        $this->menu ='general_store';
        $this->sub_menu ='report';
        $branch_id= $this->session->userdata('companyId');
        $data['branch_info']=$this->m_common->get_row_array('department',array('d_id'=>$branch_id),'*');
        $postData = $this->input->post();
        if(!empty($postData)){
            
           $report_type=$this->input->post('report_type');  
           $report_format=$this->input->post('report_format'); 
            
           $item=$this->input->post('item');
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $from_date=date('Y-m-d',strtotime($f_date));
           $too_date=date('Y-m-d',strtotime($to_date));
           $data['report_type']=$report_type;
           $data['report_format']=$report_format;
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
           if($report_format=="general"){
                    if($report_type=="summary"){
                         if($item=="all"){
                           // $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                           //  $data['items']=$this->m_common->get_row_array('items','','*','','','item_name');
                             $sql="select i.*,tmu.meas_unit from items i left join tbl_measurement_unit tmu on i.mu_id=tmu.id";
                             $data['items']=$this->m_common->customeQuery($sql);
                         }else{
                             //$data['items']=$this->m_common->get_row_array('items',array('id'=>$item),'*'); 
                             $sql="select i.*,tmu.meas_unit from items i left join tbl_measurement_unit tmu on i.mu_id=tmu.id where i.id=".$item;
                             $data['items']=$this->m_common->customeQuery($sql);
                         }

                          foreach($data['items'] as $key=>$item_info){
                             $issue_qty=array();
                             $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$from_date.'" and consumption_date<="'.$too_date.'" and item_id='.$item_info['id'].' and status="Approved" and unit_id='.$branch_id;
                             $issue_qty=$this->m_common->customeQuery($sql);
                             if(!empty($issue_qty[0]['issue_qty'])){
                                  $data['items'][$key]['issue_qty']=$issue_qty[0]['issue_qty'];
                                  $data['items'][$key]['issue_value']=$issue_qty[0]['issue_value'];
                             }else{
                                 $data['items'][$key]['issue_qty']=0; 
                                 $data['items'][$key]['issue_value']=0;
                                 unset($data['items'][$key]);
                             }


                          }

                           $data['data']=$data['items'];
                    }else{
                        if($item=="all"){
                           $sql='Select tic.*,i.item_name,tmu.meas_unit from tbl_item_comsumption tic left join items i on tic.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where tic.consumption_date>="'.$from_date.'" and tic.consumption_date<="'.$too_date.'" and tic.status="Approved" and tic.unit_id='.$branch_id.' order by tic.consumption_date ';
                        }else{
                            $sql='Select tic.*,i.item_name,tmu.meas_unit from tbl_item_comsumption tic left join items i on tic.item_id=i.id left join tbl_measurement_unit tmu on i.mu_id=tmu.id where tic.consumption_date>="'.$from_date.'" and tic.consumption_date<="'.$too_date.'" and tic.item_id='.$item.' and tic.status="Approved" and tic.unit_id='.$branch_id;
                        }
                        $issued_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$issued_qty;

                    }         
           }else if($report_format=="project"){
                $item=$this->input->post('item');
                $data['departments']=$this->m_common->get_row_array('department','','*');
                 if($report_type=="summary"){
                       
                          $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                        

                          foreach($data['items'] as $key=>$item_info){
                              
                             $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$from_date.'" and consumption_date<="'.$too_date.'" and item_id='.$item_info['id'].' and department_id='.$item.' and status="Approved" ';
                             $issue_qty=$this->m_common->customeQuery($sql);
                             if(!empty($issue_qty[0]['issue_qty'])){
                                  $data['items'][$key]['issue_qty']=$issue_qty[0]['issue_qty'];
                                  $data['items'][$key]['issue_value']=$issue_qty[0]['issue_value'];
                             }else{
                                 $data['items'][$key]['issue_qty']=0; 
                                 $data['items'][$key]['issue_value']=0;
                                 unset($data['items'][$key]);
                             }
                               
                              
                              
                             


                         }

                           $data['data']=$data['items'];
                    }else{
                        $sql='Select * from tbl_item_comsumption where consumption_date>="'.$from_date.'" and consumption_date<="'.$too_date.'" and department_id='.$item.' and status="Approved" order by consumption_date ';
                        
                        $receive_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$receive_qty;

                    }         
           }else{
                $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Asset"),'*','','','item_name');
                $item=$this->input->post('item');
                 if($report_type=="summary"){
                       
                          $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                        

                          foreach($data['items'] as $key=>$item_info){
                             $sql='Select sum(consumption_quantity) as issue_qty,sum(amount) as issue_value from tbl_item_comsumption where consumption_date>="'.$from_date.'" and consumption_date<="'.$too_date.'" and item_id='.$item_info['id'].' and asset_id='.$item.' and status="Approved" and unit_id='.$branch_id;
                             $issue_qty=$this->m_common->customeQuery($sql);
                             if(!empty($issue_qty[0]['issue_qty'])){
                                  $data['items'][$key]['issue_qty']=$issue_qty[0]['issue_qty'];
                                  $data['items'][$key]['issue_value']=$issue_qty[0]['issue_value'];
                             }else{
                                 $data['items'][$key]['issue_qty']=0; 
                                 $data['items'][$key]['issue_value']=0;
                                 unset($data['items'][$key]);
                             }
                          }

                           $data['data']=$data['items'];
                    }else{
                      
                       $sql='Select * from issue_session_details where issue_date>="'.$from_date.'" and issue_date<="'.$too_date.'" and asset_id='.$item.' and issue_status="issued" order by issue_date ';
                        
                        $receive_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$receive_qty;

                    }         
           }
           
           
           
        }else{
           $item='';
           $f_date='';
           $to_date='';
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name'); 
        }
       // $this->load->view('report/issue_report',$data);
         if($print==false){
             $this->load->view('report/adjustment_report',$data);
        }else{
           $html=$this->load->view('report/print_adjustment_report', $data,true);
           echo $html;exit; 
        }
    }
    
    
    
    
      function returnReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        
        $postData = $this->input->post();
        if(!empty($postData)){
            
          $report_type=$this->input->post('report_type');  
          $report_format=$this->input->post('report_format'); 
            
           $item=$this->input->post('item');
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $from_date=date('Y-m-d',strtotime($f_date));
           $too_date=date('Y-m-d',strtotime($to_date));
           $data['report_type']=$report_type;
           $data['report_format']=$report_format;
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
           if($report_format=="general"){
                    if($report_type=="summary"){
                         if($item=="all"){
                            $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                         }else{
                             $data['items']=$this->m_common->get_row_array('items',array('id'=>$item),'*'); 
                         }

                          foreach($data['items'] as $key=>$item_info){
                             $sql='Select sum(return_qty) as ret_qty,sum(return_value) as ret_value from return_receive_details where rr_date>="'.$from_date.'" and rr_date<="'.$too_date.'" and item_id='.$item_info['id'].' and rr_d_status="returned" ';
                             $return_qty=$this->m_common->customeQuery($sql);
                             if(!empty($return_qty[0]['ret_qty'])){
                                  $data['items'][$key]['return_qty']=$return_qty[0]['ret_qty'];
                                  $data['items'][$key]['return_value']=$return_qty[0]['ret_value'];
                             }else{
                                 $data['items'][$key]['return_qty']=0; 
                                 $data['items'][$key]['return_value']=0;
                             }


                          }

                           $data['data']=$data['items'];
                    }else{
                        if($item=="all"){
                             $sql='Select * from return_receive_details where rr_date>="'.$from_date.'" and rr_date<="'.$too_date.'" and rr_d_status="returned" order by rr_date ';
                        }else{
                             $sql='Select * from return_receive_details where rr_date>="'.$from_date.'" and rr_date<="'.$too_date.'" and item_id='.$item.' and rr_d_status="returned" ';
                        }
                        $issued_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$issued_qty;

                    }         
           }else if($report_format=="project"){
                $item=$this->input->post('item');
                $data['departments']=$this->m_common->get_row_array('department','','*');
                 if($report_type=="summary"){
                       
                          $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                        

                          foreach($data['items'] as $key=>$item_info){
                              
                             $sql='Select sum(return_qty) as ret_qty,sum(return_value) as ret_value from return_receive_details where rr_date>="'.$from_date.'" and rr_date<="'.$too_date.'" and item_id='.$item_info['id'].' and department_id='.$item.' and rr_d_status="returned" ';
                             $return_qty=$this->m_common->customeQuery($sql);
                             if(!empty($return_qty[0]['ret_qty'])){
                                  $data['items'][$key]['return_qty']=$return_qty[0]['ret_qty'];
                                  $data['items'][$key]['return_value']=$return_qty[0]['ret_value'];
                             }else{
                                 $data['items'][$key]['return_qty']=0; 
                                 $data['items'][$key]['return_value']=0;
                                 unset($data['items'][$key]);
                             }
                              
                               
                              
                             


                          }

                           $data['data']=$data['items'];
                    }else{
                        $sql='Select * from return_receive_details where rr_date>="'.$from_date.'" and rr_date<="'.$too_date.'" and department_id='.$item.' and rr_d_status="returned" order by rr_date ';
                       
                        $receive_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$receive_qty;

                    }         
           }else{
                $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Asset"),'*','','','item_name');
                $item=$this->input->post('item');
                 if($report_type=="summary"){
                       
                          $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name');
                        

                          foreach($data['items'] as $key=>$item_info){
                             $sql='Select sum(return_qty) as ret_qty,sum(return_value) as ret_value from return_receive_details where rr_date>="'.$from_date.'" and rr_date<="'.$too_date.'" and item_id='.$item_info['id'].' and asset_id='.$item.' and rr_d_status="returned" ';
                             $return_qty=$this->m_common->customeQuery($sql);
                             if(!empty($return_qty[0]['ret_qty'])){
                                  $data['items'][$key]['return_qty']=$return_qty[0]['ret_qty'];
                                  $data['items'][$key]['return_value']=$return_qty[0]['ret_value'];
                             }else{
                                 $data['items'][$key]['return_qty']=0; 
                                 $data['items'][$key]['return_value']=0;
                                 unset($data['items'][$key]);
                             }
                          }

                           $data['data']=$data['items'];
                    }else{
                      
                        $sql='Select * from return_receive_details where rr_date>="'.$from_date.'" and rr_date<="'.$too_date.'" and asset_id='.$item.' and rr_d_status="returned" order by rr_date ';
                       
                        $receive_qty=$this->m_common->customeQuery($sql);
                        $data['data']=$receive_qty;

                    }         
           }
           
           
           
        }else{
           $item='';
           $f_date='';
           $to_date='';
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*','','','item_name'); 
        }
      //  $this->load->view('report/return_report',$data);
         if($print==false){
             $this->load->view('report/return_report',$data);
        }else{
           $html=$this->load->view('report/print_return_report', $data,true);
           echo $html;exit; 
        }
    }
    
    
    
    
    function itemReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $data['report_format']=$report_format;
           $item=$this->input->post('item');
           $stock_amount=$this->input->post('stock_amount');
           $stock_type=$this->input->post('stock_type');
           $data['stock_amount']=$stock_amount;
           $data['stock_type']=$stock_type;
         
           $data['item_id']=$item;
           
          if(!empty($report_format)&&!empty($item)&& (!empty($stock_amount) || $stock_amount=='0') ){
              if(!empty($stock_amount) && !empty($stock_type) &&  $stock_type=="above"){
                $sql='select * from v_items where item_type="'.$report_format.'" and item_group_id='.$item.' and stock_amount >'.$stock_amount.' order by item_name';
              }else  if(!empty($stock_amount) && !empty($stock_type) &&  $stock_type=="below"){
                $sql='select * from v_items where item_type="'.$report_format.'" and item_group_id='.$item.' and stock_amount <'.$stock_amount.' order by item_name';  
              }else{
                $sql='select * from v_items where item_type="'.$report_format.'" and item_group_id='.$item.' and stock_amount='.$stock_amount.' order by item_name';
              }   
              $data['items']=$this->m_common->customeQuery($sql);
              
          }else if(!empty($report_format) && !empty($item)){
              if(!empty($stock_amount) && !empty($stock_type) &&  $stock_type=="above"){
                $sql='select * from v_items where item_type="'.$report_format.'" and item_group_id='.$item.' and stock_amount >'.$stock_amount.' order by item_name';
              }else  if(!empty($stock_amount) && !empty($stock_type) &&  $stock_type=="below"){
                  $sql='select * from v_items where item_type="'.$report_format.'" and item_group_id='.$item.' and stock_amount <'.$stock_amount.' order by item_name';
              }else{
                  $sql='select * from v_items where item_type="'.$report_format.'" and item_group_id='.$item.' order by item_name';
              }
              $data['items']=$this->m_common->customeQuery($sql);
          }else if(!empty($report_format)&&(!empty($stock_amount) || $stock_amount=='0')){
              if(!empty($stock_amount) && !empty($stock_type) &&  $stock_type=="above"){
                 $sql='select * from v_items where item_type="'.$report_format.'" and stock_amount >'.$stock_amount.' order by item_name';
              }else  if(!empty($stock_amount) && !empty($stock_type) &&  $stock_type=="below"){
                 $sql='select * from v_items where item_type="'.$report_format.'" and stock_amount <'.$stock_amount.' order by item_name';  
              }else{
                 $sql='select * from v_items where item_type="'.$report_format.'" and stock_amount='.$stock_amount.' order by item_name';
              }
              $data['items']=$this->m_common->customeQuery($sql);
          }else{
               $sql='select * from v_items where item_type="'.$report_format.'"';
               $data['items']=$this->m_common->customeQuery($sql);
          }
        
           
           
             $data['groups']=$this->m_common->get_row_array('item_groups',array('group_type'=>$report_format),'*');
             $data['data']=$data['items'];
               
          
        }else{
          
         
           $data['groups']=$this->m_common->get_row_array('item_groups',array('group_type'=>"Consumable"),'*');
           $data['items']=$this->m_common->get_row_array('v_items','','*','','','item_name');
           $data['data']=$data['items'];
        }
      //  $this->load->view('report/item_report',$data);
        if($print==false){
             $this->load->view('report/item_report',$data);
        }else{
           $html=$this->load->view('report/print_item_report', $data,true);
           echo $html;exit; 
        }
    }
    
    
    
    
    function assetPurchaseReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $data['report_format']=$report_format;
           $item=$this->input->post('item');
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           if(!empty($f_date)){
               $from_date=date('Y-m-d',strtotime($f_date));
           }else{
               $from_date='';
           }
           
           if(!empty($to_date)){
               $too_date=date('Y-m-d',strtotime($to_date));
           }else{
               $too_date='';
           }
          // $too_date=date('Y-m-d',strtotime($to_date));
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           
           $data['item_id']=$item;
           $data['item_check']=$item;
           $data['groups']=$this->m_common->get_row_array('item_groups',array('group_type'=>'Asset'),'*');
           
            if($report_format=='general'){
                    $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Asset"),'*','','','item_name');
//                    if($item=="all"){
//                       $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Asset"),'*','','','item_name');
//                    }else{
//                       $data['items']=$this->m_common->get_row_array('items',array('id'=>$item),'*'); 
//                    }
           }else{
               
               if($item=='all'){
                   $data['group']=$this->m_common->get_row_array('item_groups',array('group_type'=>"Asset"),'*');   
               }else{
                   $data['group_info']=$this->m_common->get_row_array('item_groups',array('id'=>$item),'*'); 
               }
                    
               
           }
           
           
           if(($report_format=='general' && $item=="all") || $report_format=='group' ){
                if($item=="all" && $report_format=='group' ){
                     if(!empty($from_date) && !empty($too_date)){
                            foreach($data['group'] as $key1=>$gr){
                                    $sql="select * from  v_asset_receive where item_group=".$gr['id']." and (receive_date>='$from_date' and receive_date<='$too_date' )";;
                                    $data['group'][$key1]['group_items']=$this->m_common->customeQuery($sql);       

                            }
                     }else{
                           foreach($data['group'] as $key1=>$gr){
                                    $sql="select * from  v_asset_receive where item_group=".$gr['id'];
                                    $data['group'][$key1]['group_items']=$this->m_common->customeQuery($sql);       

                            }
                     }         
//                    echo '<pre>';
//                    print_r($data['group']);
//                    echo '</pre>';
//                    exit;
                }else if($item!="all" && $report_format=='group'){
                    if(!empty($from_date) && !empty($too_date)){
                        $sql="select * from  v_asset_receive where item_group=".$item." and (receive_date>='$from_date' and receive_date<='$too_date' )";
                        $data['items']=$this->m_common->customeQuery($sql);
                    }else{
                        $sql="select * from  v_asset_receive where item_group=".$item;
                        $data['items']=$this->m_common->customeQuery($sql);
                    }
                }else{
                    if(!empty($from_date) && !empty($too_date)){
                        $sql="select * from  v_asset_receive where group_type='Asset' and receive_date>='$from_date' and receive_date<='$too_date' ";
                        $data['items']=$this->m_common->customeQuery($sql);
                    }else{
                        $sql="select * from  v_asset_receive where group_type='Asset' ";
                        $data['items']=$this->m_common->customeQuery($sql);
                    }
                }
                
                //$data['data']=$data['items'];
           }else{
               if(!empty($from_date) && !empty($too_date)){
                   $sql="select * from  v_asset_receive where item_id=".$item." and (receive_date>='$from_date' and receive_date<='$too_date' )";
                   $data['items']=$this->m_common->customeQuery($sql); 
               }else{
                   $sql="select * from  v_asset_receive where item_id=".$item;
                    $data['items']=$this->m_common->customeQuery($sql);
               }
           }
           
           
           
           
//           if($group=="all"){
//               
//           }else{
//                $sql="select * from  v_material_receive_requisition_details where department_id=".$group;
//                $data['purchase_asset_info']=$this->m_common->customeQuery($sql);
//           }
          
               
          
        }else{
          
           $data['groups']=$this->m_common->get_row_array('item_groups',array('group_type'=>"Asset"),'*');
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Asset"),'*'); 
           //$data['data']=$data['items'];
        }
        if($print==false){
             $this->load->view('report/asset_purchase_report',$data);
        }else{
            $html=$this->load->view('report/print_asset_purchase_report', $data,true);
            echo $html;exit; 
        }
    }
    
    function budgetReport(){
        if($print==false){
             $this->load->view('report/budget_report',$data);
        }else{
            $html=$this->load->view('report/print_budget_report', $data,true);
            echo $html;exit; 
        }
    }
    
    function assetMovementReport($print=false){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        $postData = $this->input->post();
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
           $item=$this->input->post('item');
           $data['f_date']=$f_date;
           $data['to_date']=$to_date; 
           $data['item_id']=$item;
           $data['item_check']=$item;
           $data['projects']=$this->m_common->get_row_array('department','','*');
    
               if($item=='all'){
                    $data['project']=$this->m_common->get_row_array('department','','*');
                           foreach($data['project'] as $key1=>$gr){
                                    $sql="select * from  v_asset_issue_details where department_id=".$gr['d_id']." and (issue_status='issued' or issue_status='partial_received' )";
                                    $data['project'][$key1]['project_items']=$this->m_common->customeQuery($sql);
                                    if(!empty($data['project'][$key1]['project_items'])){
                                        foreach($data['project'][$key1]['project_items'] as $key2=>$pro_item){
                                            $data['project'][$key1]['project_items'][$key2]['total']=$pro_item['issue_qty']-$pro_item['receive_qty'];
                                        }
                                    }

                            }
               }else{
                   $sql="select * from  v_asset_issue_details where department_id=".$item." and (issue_status='issued' or issue_status='partial_received' )";
                   $data['items']=$this->m_common->customeQuery($sql);
                   if(!empty($data['items'])){
                       foreach($data['items'] as $key=>$pro_item){
                            $data['items'][$key]['total']=$pro_item['issue_qty']-$pro_item['receive_qty'];
                       }
                   }
                   $data['group_info']=$this->m_common->get_row_array('department',array('d_id'=>$item),'*'); 
               }
                    
               
           
             
        }else{
          
           $data['projects']=$this->m_common->get_row_array('department','','*');
         
       
        }
        if($print==false){
            $this->load->view('report/asset_movement_report',$data);
        }else{
            $html=$this->load->view('report/print_asset_movement_report', $data,true);
            echo $html;exit; 
        }
    }
    
    
    
    
    function pettyCashReceivedReport($print=false){
        $this->menu='general_store';
        $this->sub_menu = 'report';
        $postData = $this->input->post();
        $branch_id= $this->session->userdata('companyId');
        $where='';
       // $where="imi.department_id=$branch_id";
        $postData = $this->input->post();
        
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
          
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');        
           $project_id=$this->input->post('d_id');      
         
           
           
          
           
           if(!empty($project_id)){
               $data['project_id']=$project_id;
                if(empty($where)){
                    $where.="tb.unit_id=$project_id";
                }else{
                    $where.=" and tb.unit_id=$project_id";
                }
           }else{
               $data['project_id']='';
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
           }else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           if(!empty($f_date) & !empty($to_date)){
             if(!empty($where)){  
                $sql="select tb.*from tbl_balance tb where $where and tb.balance_date>='".$from_date."' and tb.balance_date<='".$too_date."' order by tb.balance_date ASC"; 
             }else{
                $sql="select tb.*from tbl_balance tb where tb.balance_date>='".$from_date."' and tb.balance_date<='".$too_date."' order by tb.balance_date ASC";  
             }
           }else if(!empty($f_date)){
             if(!empty($where)){  
                $sql="select tb.*from tbl_balance tb where $where and tb.balance_date>='".$from_date."' order by tb.balance_date ASC"; 
             }else{
                $sql="select tb.*from tbl_balance tb where tb.balance_date>='".$from_date."' order by tb.balance_date ASC";  
             }
           }else if(!empty($to_date)){
             if(!empty($where)){  
                $sql="select tb.*from tbl_balance tb where $where and tb.balance_date<='".$to_date."' order by tb.balance_date ASC"; 
             }else{
                $sql="select tb.*from tbl_balance tb where tb.balance_date<='".$to_date."' order by tb.balance_date ASC";  
             }
           }else{
              if(!empty($where)){  
                $sql="select tb.*from tbl_balance tb where $where order by tb.balance_date ASC"; 
             }else{
                $sql="select tb.*from tbl_balance tb order by tb.balance_date ASC";  
             }
           }
           $data['balances']=$this->m_common->customeQuery($sql);           
           $data['projects']=$this->m_common->get_row_array('department','','*');          
           $this->load->view('report/petty_cash_received_report',$data);
           
        }else{          
           $data['project_id']=$branch_id;
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $data['balances'] = $this->m_common->get_row_array('tbl_balance', array('unit_id'=>$branch_id), '*');
          
           $this->load->view('report/petty_cash_received_report',$data);
         
       
        }
        
    }
    
     
  function expenseReport($print=false){
        $this->menu='general_store';
        $this->sub_menu = 'report';
        $postData = $this->input->post();
        $branch_id= $this->session->userdata('companyId');
        $where='';
       // $where="imi.department_id=$branch_id";
        $postData = $this->input->post();
        
        if(!empty($postData)){
           $report_format=$this->input->post('report_format'); 
          
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');        
           $project_id=$this->input->post('d_id');      
         
           
           
          
           
           if(!empty($project_id)){
               $data['project_id']=$project_id;
                if(empty($where)){
                    $where.="te.unit_id=$project_id";
                }else{
                    $where.=" and te.unit_id=$project_id";
                }
           }else{
               $data['project_id']='';
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
           }else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           if(!empty($f_date) & !empty($to_date)){
             if(!empty($where)){  
                $sql="select te.*from tbl_expense te where $where and te.expense_date>='".$from_date."' and te.expense_date<='".$too_date."' order by te.expense_date ASC"; 
             }else{
                $sql="select te.*from tbl_expense te where te.expense_date>='".$from_date."' and te.expense_date<='".$too_date."' order by te.expense_date ASC";  
             }
           }else if(!empty($f_date)){
             if(!empty($where)){  
                $sql="select te.*from tbl_expense te where $where and te.expense_date>='".$from_date."' order by te.expense_date ASC"; 
             }else{
                $sql="select te.*from tbl_expense te where te.expense_date>='".$from_date."' order by te.expense_date ASC";  
             }
           }else if(!empty($to_date)){
             if(!empty($where)){  
                $sql="select te.*from tbl_expense te where $where and te.expense_date<='".$to_date."' order by te.expense_date ASC"; 
             }else{
                $sql="select te.*from tbl_expense te where te.expense_date<='".$to_date."' order by te.expense_date ASC";  
             }
           }else{
              if(!empty($where)){  
                $sql="select te.*from tbl_expense te where $where order by te.expense_date ASC"; 
             }else{
                $sql="select te.*from tbl_expense te order by te.expense_date ASC";  
             }
           }
           $data['expenses']=$this->m_common->customeQuery($sql);           
           $data['projects']=$this->m_common->get_row_array('department','','*');          
           $this->load->view('report/expense_report',$data);
           
        }else{          
           $data['project_id']=$branch_id;
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $data['expenses'] = $this->m_common->get_row_array('tbl_expense', array('unit_id'=>$branch_id), '*');
          
           $this->load->view('report/expense_report',$data);
         
       
        }
        
    }
    
    
    function supplierLedgerReport(){
        $branch_id = $this->session->userdata('companyId');
        $postData = $this->input->post();
        $supplier_id=$this->input->post('supplier_id');
        if(!empty($postData)){
          if(!empty($supplier_id)){  
            $data['supplier_id']=$supplier_id; 
          }else{
            $data['supplier_id']='';  
          }
       // $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
          $data['f_date'] = $from_date = date('Y-m-d',strtotime($this->input->post('from_date')));
          $data['to_date'] = $too_date = date('Y-m-d',strtotime($this->input->post('to_date')));  
          if(!empty($supplier_id)){ 
            $sql="select v.*,o.order_no,s.SUP_NAME,s.opening_balance,s.ID,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on o.supplier_id=s.ID left join department d on o.unit_id=d.d_id where o.supplier_id=".$supplier_id." group by o.supplier_id";
          }else{
            $sql="select v.*,o.order_no,s.SUP_NAME,s.opening_balance,s.ID,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on o.supplier_id=s.ID left join department d on o.unit_id=d.d_id group by o.supplier_id";
          }
          $data['suppliers']= $this->m_common->customeQuery($sql);
        
        }else{
            $sql="select v.*,o.order_no,s.SUP_NAME,s.opening_balance,s.ID,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on o.supplier_id=s.ID left join department d on o.unit_id=d.d_id group by o.supplier_id";
            $data['suppliers']= $this->m_common->customeQuery($sql);
            $data['f_date'] = $from_date = date('Y-m-01');
            $data['to_date'] = $too_date = date('Y-m-t');
            $data['supplier_id']='';
        }
        
        $sql="select v.*,o.order_no,s.SUP_NAME,s.ID,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on o.supplier_id=s.ID left join department d on o.unit_id=d.d_id group by o.supplier_id";
        $data['all_suppliers']= $this->m_common->customeQuery($sql);
        $this->load->view('report/v_supplier_ledger_report',$data);
    }
    
    
    
    function purchaseInvoiceReport(){
        $branch_id= $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        
        $this->titlebackend("Purchase Invoices Report");
        
        $postData = $this->input->post();
        if(!empty($postData)){
           
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');        
           $project_id=$this->input->post('d_id');      
           $supplier_id=$this->input->post('supplier_id');
           $status=$this->input->post('status');
           
           $where.="v.is_active=1";
           if(!empty($project_id)){
               $data['project_id']=$project_id;
                if(empty($where)){
                    $where.="o.unit_id=$project_id";
                }else{
                    $where.=" and o.unit_id=$project_id";
                }
           }else{
               $data['project_id']='';
           }
           
           
           
           if(!empty($supplier_id)){
               $data['supplier_id']=$supplier_id;
                if(empty($where)){
                    $where.="o.supplier_id=$supplier_id";
                }else{
                    $where.=" and o.supplier_id=$supplier_id";
                }
           }else{
              $data['supplier_id']=''; 
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
           }else{
               $data['f_date']='';
               $data['to_date']='';
           }
           
           if(!empty($f_date) & !empty($to_date)){
              $sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on o.supplier_id=s.ID left join department d on o.unit_id=d.d_id where $where and v.invoice_date>='".$from_date."' and v.invoice_date<='".$too_date."' order by v.invoice_date ASC";              
           }else{
              $sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on o.supplier_id=s.ID left join department d on o.unit_id=d.d_id where $where  order by v.invoice_date ASC";
           }
           
           
           
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           $data['invoices']=$this->m_common->customeQuery($sql);
           $this->load->view('report/purchase_invoice_report',$data);
              
        }else{    
            
           $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
           
           $data['projects']=$this->m_common->get_row_array('department','','*');
           $sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on o.supplier_id=s.ID left join department d on o.unit_id=d.d_id where v.is_active=1";        
           $data['invoices']=$this->m_common->customeQuery($sql);
           $this->load->view('report/purchase_invoice_report',$data);
         
       
        }
    }
    
    
    
    function invoiceAgingSummaryReport($print=false){
        $branch_id= $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        
        $this->titlebackend("Purchase Invoices Report");
        
        $branch_id = $this->session->userdata('companyId');
        $data['branch_info'] = $this->m_common->get_row_array('department', array('d_id' => $branch_id), '*');
        $where = '';
    //    $where = "inv.unit_id=$branch_id";
        
        $f_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');
        
        
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
        
        
        $postData = $this->input->post();
        if(!empty($postData)){
            $supplier_id = $this->input->post('supplier_id');
            $data['supplier_id']=$supplier_id;
            if(!empty($customer_id)){
                $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
            }else{
                $data['suppliers']=$this->m_common->get_row_array('supplier','','*');
            }
        }else{
            $data['supplier_id'] = '';
            $data['suppliers'] = $this->m_common->get_row_array('supplier','','*');
        }
        
        foreach($data['suppliers'] as $key=>$value){
            
            $sql="select v.*,o.order_no,s.SUP_NAME,d.dep_description from tbl_purchase_invoices v left join tbl_purchase_orders o on v.po_id=o.o_id left join supplier s on o.supplier_id=s.ID left join department d on o.unit_id=d.d_id where v.is_active=1";                 
            $data['suppliers'][$key]['invoices'] = $this->m_common->customeQuery($sql);
            if(empty($data['suppliers'][$key]['invoices'])){
                unset($data['suppliers'][$key]);
            }
        }
        $data['suppliers_info'] = $this->m_common->get_row_array('supplier','','*');
        
        if ($print == false) {
            $this->load->view('report/aging_summary_report',$data);
        } else {
            $html = $this->load->view('report/print_aging_summary_report',$data,true);
            echo $html;
            exit;
        }
    }
    
    
    
    
    
    function project_or_asset_or_item(){
        $this->setOutputMode(NORMAL);
         $reportformat=$this->input->post('reportformat');
         if($reportformat=="project"){
           $data['data']=$this->m_common->get_row_array('department','','*');   
         }else if($reportformat=="assets"){
           $data['data']=$this->m_common->get_row_array('items',array('item_type'=>"Asset"),'*'); 
         }else{
           $data['data']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*');   
         }
        
       
          echo json_encode($data);
    }
    
    
      function group_or_item(){
        $this->setOutputMode(NORMAL);
         $reportformat=$this->input->post('reportformat');
         if($reportformat=="group"){
           $data['data']=$this->m_common->get_row_array('item_groups',array('group_type'=>"Consumable"),'*');   
         }else{
           $data['data']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*');   
         }
        
       
          echo json_encode($data);
    }
    
     function asset_group_or_item(){
        $this->setOutputMode(NORMAL);
         $reportformat=$this->input->post('reportformat');
         if($reportformat=="group"){
           $data['data']=$this->m_common->get_row_array('item_groups',array('group_type'=>"Asset"),'*');   
         }else{
           $data['data']=$this->m_common->get_row_array('items',array('item_type'=>"Asset"),'*');   
         }
        
       
          echo json_encode($data);
    }
    
    
    
       function group_info(){
          $this->setOutputMode(NORMAL);
          $reportformat=$this->input->post('reportformat');
        
         $data['data']=$this->m_common->get_row_array('item_groups',array('group_type'=>$reportformat),'*');
//          $data['data1']=$this->m_common->get_row_array('item_category',array('c_type'=>$reportformat),'*'); 
        
   //       $data['data']=$this->m_common->get_row_array('item_groups','','*');
    //      $data['data1']=$this->m_common->get_row_array('item_category','','*'); 
        
       
          echo json_encode($data);
    }
    
    
    function get_item_brand(){
        $this->setOutputMode(NORMAL);
        $item_id=$this->input->post('item_id');
        $item=$this->m_common->get_row_array('items',array('id'=>$item_id),'*');
        $brands= $this->m_common->get_row_array('tbl_item_brand',array('is_active'=>1), '*');
        $item_brands=  unserialize($item[0]['brand_id']);
        $b=array();
        foreach($brands as $key1=>$brand){
                if(!empty($item_brands)){  
                    if(in_array($brand['id'],$item_brands)){
                      $b[]=$brand;
                    }else{
                         unset($brands[$key1]);
                    }
                }else{
                    $b='';
                }
        }        
        $data['brands']=$b;
        echo json_encode($data);
    }
    
   
    
    
 }
