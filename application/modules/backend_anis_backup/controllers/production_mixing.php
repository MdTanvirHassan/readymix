<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Production_mixing extends Site_Controller {

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
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'production_mixing';
        $this->titlebackend("Production Mixing");
        $sql="select tpm.*,tsp.product_name,tdo.delivery_no,tdo.project_name,tc.c_name from tbl_production_mixing tpm
        left join tbl_production_schedule_details tpsd on tpm.schedule_d_id=tpsd.id 
        left join tbl_delivery_orders tdo on tpsd.do_id=tdo.do_id 
        left join tbl_sales_products tsp on tpsd.product_id=tsp.product_id 
        left join tbl_sales_orders tso on tdo.o_id=tso.o_id 
        left join tbl_customers tc on tc.id=tso.customer_id 
        where tpm.branch_id=$branch_id and tpm.is_active=1 order by tpsd.id desc";
        $data['production_mixing']=$this->m_common->customeQuery($sql);
        //echo '<pre>';print_r($data['production_mixing']);
        $this->load->view('production_mixing/v_production_mixing',$data);
    }

   
    function add_production_mixing() {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'production_mixing';
        $this->titlebackend("Production Mixing");
        $data['branch_info']=$this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
        $mixing_last_code=$this->m_common->get_row_array('tbl_production_mixing_code',array('branch_id'=>$branch_id),'*','',1,'id','DESC');
        if(!empty($mixing_last_code)){      
            $mixing_code=$mixing_last_code[0]['mixing_code']+1;
            if($mixing_code>999){
                $mixing_sl_no=$mixing_code;
            }else if($mixing_code>99){
                $mixing_sl_no="0".$mixing_code;
            }else if($mixing_code>9){
                $mixing_sl_no="00".$mixing_code;
            }else{
                $mixing_sl_no="000".$mixing_code;
            }
        }else{
            $mixing_code=1;
            $mixing_sl_no='0001';
        }
   
        $data['mixing_code']=$mixing_code;
        $data['mixing_auto_code']=$mixing_sl_no;
     
      //  $sql="select dod.*,do.delivery_no,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_delivery_order_details dod left join tbl_sales_products sp on dod.s_item_id=sp.product_id left join tbl_delivery_orders do on dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join  tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.do_status='Approved' and do.is_active=1 ";
      //  $sql="select tpsd.*,tdo.delivery_no,tsp.product_name,tps.schedule_no from tbl_production_schedule_details tpsd join tbl_production_schedule tps on tpsd.schedule_id=tps.id left join tbl_delivery_orders tdo on tpsd.do_id=tdo.do_id left join tbl_sales_products tsp on tpsd.product_id=tsp.product_id where tpsd.mixing_status='Pending'  or tpsd.mixing_status is null";
        $sql="select tpsd.*,tdo.delivery_no,tsp.product_name,tps.schedule_no from tbl_production_schedule_details tpsd join tbl_production_schedule tps on tpsd.schedule_id=tps.id left join tbl_delivery_orders tdo on tpsd.do_id=tdo.do_id left join tbl_sales_products tsp on tpsd.product_id=tsp.product_id where (tpsd.mixing_status='Pending'  or tpsd.mixing_status is null) and tpsd.branch_id=".$branch_id;
        $data['details_schedule']=$this->m_common->customeQuery($sql);
        $this->load->view('production_mixing/v_add_production_mixing',$data);
    }
   
   
    
    
    
    function add_production_mixing_action(){        
        $branch_id= $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $userData = $this->m_common->get_row_array('users', array('id' =>$user_id), '*');
        $insertData['created_by'] = $userData[0]['employeeId'];
        $approver =fetch_approver(13,58, $userData);
        
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'production_mixing';
        $this->titlebackend("Production Mixing");
        
        $postData=$this->input->post();
        if(!empty($postData)){
           
        $insertData = array();   
       
          
        if(!empty($postData['pm_no'])){
            $insertData['pm_no'] = $postData['pm_no'];   
            $pre_mixing_info=$this->m_common->get_row_array('tbl_production_mixing', array('pm_no' =>$postData['pm_no'],'branch_id'=>$branch_id,'is_active'=>1),'*');
            if(!empty($pre_mixing_info)){
                redirect_with_msg('production_mixing/add_production_mixing', 'This mixing already exists');
            }
         }
            
         if(!empty($postData['schedule_d_id'])){
              $insertData['schedule_d_id'] = $postData['schedule_d_id']; 
              $s_d_id= $postData['schedule_d_id']; 
         }
           
         if(!empty($postData['casting_size'])){
              $insertData['casting_size'] = $postData['casting_size'];   
         }
          
         if(!empty($postData['casting_size_cft'])){
              $insertData['casting_size_cft'] = $postData['casting_size_cft'];   
         }
          
         $insertData['approver_id'] =$approver[0];
         $insertData['branch_id']=$branch_id;
         $insertData['created_by']=$employee_id;
         $insertData['is_active']=1;
         $insertData['status']='Pending';
         $insertData['created_date']=date('Y-m-d');
         $insertData['created_date_time']=date("Y-m-d h:i:sa");
         
         $result=$this->m_common->insert_row('tbl_production_mixing',$insertData);
             if(!empty($result)){
                 $this->m_common->insert_row('tbl_production_mixing_code',array('mixing_code'=>$postData['mixing_code'],'branch_id'=>$branch_id));
               //  $this->m_common->update_row('tbl_sales_orders', array('o_id' =>$o_id),array('status'=>"Generated Delivery Order"));
                
                  foreach ($postData['item_id'] as $key=>$each) {
                     
                           if(empty($each)){
                                continue;
                            }
                            
                            $insertData1=array();
                            $insertData1['pm_id'] = $result;
                            $insertData1['item_id'] = $each;
                            $insertData1['is_active']=1;
                            //$insertData1['branch_id']=$branch_id;
                                                      
                            if(!empty($postData['qty'][$key])) {
                                 $insertData1['qty'] = $postData['qty'][$key];
                            }
                            
                           if(!empty($postData['total_qty'][$key])) {
                                 $insertData1['total_qty'] = $postData['total_qty'][$key];
                           }

                           if(!empty($postData['mu'][$key])) {
                                 $insertData1['mu'] = $postData['mu'][$key];
                           }

                           if(!empty($postData['conversion_factor'][$key])){
                                 $insertData1['conversion_factor'] = $postData['conversion_factor'][$key];
                           }
                           
                          if(!empty($postData['converted_qty'][$key])){
                                 $insertData1['converted_qty'] = $postData['converted_qty'][$key];
                           }
                           
                          if(!empty($postData['total_converted_qty'][$key])){
                               $insertData1['total_converted_qty'] = $postData['total_converted_qty'][$key];
                          }
                          if(!empty($postData['converted_mu'][$key])){
                               $insertData1['converted_mu'] = $postData['converted_mu'][$key];
                          }
                           
                          if(!empty($postData['brand'][$key])){
                               $insertData1['brand'] = $postData['brand'][$key];
                          }
                            
                           $this->m_common->insert_row('tbl_production_mixing_details',$insertData1);
                       }       
                 $this->m_common->update_row('tbl_production_schedule_details',array('id'=>$s_d_id),array('mixing_status'=>"Mixed"));    
                $array = array(
                     "employee_id" =>$approver[0],
                     "title" => "Mixing approval",
                     "notice" => "Please approve the mixing",
                     "create_date" => date('Y-m-d H:i:s'),
                     "date" => date('Y-m-d'),
                     "status" => "Unseen",
                     "url" =>"production_mixing/details_production_mixing/".$result
                );
                $this->m_common->insert_row("notice", $array);  
                  
                  redirect_with_msg('production_mixing', 'Successfully Inserted');
             }
         }else{
              redirect_with_msg('production_mixing/add_production_mixing', 'Please fill the form and submit');
         }
    }
    
    
    
   function edit_production_mixing($id) {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'production_mixing';
        $this->titlebackend("Production Mixing");
        $sql = "select pm.*,sp.measurement_unit,sp.product_name,d.delivery_no from tbl_production_mixing pm JOIN tbl_production_schedule_details psd on pm.schedule_d_id=psd.id 
JOIN tbl_sales_products sp on psd.product_id=sp.product_id 
JOIN tbl_delivery_orders d on psd.do_id=d.do_id
where pm.pm_id=".$id;
       // $data['mixing_info']=$this->m_common->get_row_array('tbl_production_mixing',array('pm_id'=>$id),'*');
        $data['mixing_info']=$this->m_common->customeQuery($sql);
        //$data['mixing_info']=$this->m_common->get_row_array('tbl_production_mixing',array('pm_id'=>$id),'*');
      //  $sql="select tpsd.*,tdo.delivery_no,tsp.product_name from tbl_production_schedule_details tpsd left join tbl_delivery_orders tdo on tpsd.do_id=tdo.do_id left join tbl_sales_products tsp on tpsd.product_id=tsp.product_id where tpsd.mixing_status='Pending'";    
        $sql="select tpsd.*,tdo.delivery_no,tsp.product_name from tbl_production_schedule_details tpsd left join tbl_delivery_orders tdo on tpsd.do_id=tdo.do_id left join tbl_sales_products tsp on tpsd.product_id=tsp.product_id where tpsd.mixing_status='Pending' or tpsd.id=". $data['mixing_info'][0]['schedule_d_id'];
        $data['details_schedule']=$this->m_common->customeQuery($sql);
       
        $sql="select tpmd.*,i.item_name from tbl_production_mixing_details tpmd left join items i on tpmd.item_id=i.id where tpmd.pm_id=".$id;
        $data['mixing_details_info']=$this->m_common->customeQuery($sql);
        $this->load->view('production_mixing/v_edit_production_mixing',$data);
    }
    
    
  function edit_production_mixing_action($id){
        
        $branch_id= $this->session->userdata('companyId');
        $employee_id = $this->session->userdata('employeeId');
        
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'production_mixing';
        $this->titlebackend("Production Mixing");
        $pre_mixing_info=$this->m_common->get_row_array('tbl_production_mixing',array('pm_id'=>$id),'*');
        $postData=$this->input->post();
        if(!empty($postData)){
           
        $insertData = array();   
       
          
        if(!empty($postData['pm_no'])){
            $insertData['pm_no'] = $postData['pm_no'];   
         }
            
         if(!empty($postData['schedule_d_id'])){
              $insertData['schedule_d_id'] = $postData['schedule_d_id'];   
              $s_d_id=$postData['schedule_d_id'];   
         }
           
         if(!empty($postData['casting_size'])){
              $insertData['casting_size'] = $postData['casting_size'];   
         }
          
         if(!empty($postData['casting_size_cft'])){
              $insertData['casting_size_cft'] = $postData['casting_size_cft'];   
         }
               
       
         $insertData['updated_by']=$employee_id;
         $insertData['is_active']=1;
        
         $insertData['updated_date']=date('Y-m-d');
         $insertData['updated_date_time']=date("Y-m-d h:i:sa");
         
         $result=$this->m_common->update_row('tbl_production_mixing',array('pm_id'=>$id),$insertData);
             if($result>=0){
                 
                 $this->m_common->delete_row('tbl_production_mixing_details',array('pm_id' =>$id));
                
                  foreach ($postData['item_id'] as $key=>$each) {
                     
                           if(empty($each)){
                                continue;
                            }
                            
                            $insertData1=array();
                            $insertData1['pm_id'] = $id;
                            $insertData1['item_id'] = $each;
                            $insertData1['is_active']=1;
                            //$insertData1['branch_id']=$branch_id;
                                                      
                            if(!empty($postData['qty'][$key])) {
                                 $insertData1['qty'] = $postData['qty'][$key];
                            }
                            
                           if(!empty($postData['total_qty'][$key])) {
                                 $insertData1['total_qty'] = $postData['total_qty'][$key];
                           }

                           if(!empty($postData['mu'][$key])) {
                                 $insertData1['mu'] = $postData['mu'][$key];
                           }

                           if(!empty($postData['conversion_factor'][$key])){
                              $insertData1['conversion_factor'] = $postData['conversion_factor'][$key];
                           }
                           
                           if(!empty($postData['converted_qty'][$key])){
                                 $insertData1['converted_qty'] = $postData['converted_qty'][$key];
                           }
                           
                           if(!empty($postData['total_converted_qty'][$key])){
                                 $insertData1['total_converted_qty'] = $postData['total_converted_qty'][$key];
                           }
                           if(!empty($postData['converted_mu'][$key])){
                                 $insertData1['converted_mu'] = $postData['converted_mu'][$key];
                           }
                           
                           if(!empty($postData['brand'][$key])){
                                $insertData1['brand'] = $postData['brand'][$key];
                           }
                           
                           $this->m_common->insert_row('tbl_production_mixing_details',$insertData1);
                       } 
                       if($pre_mixing_info[0]['schedule_d_id']==$s_d_id){
                            $this->m_common->update_row('tbl_production_schedule_details',array('id'=>$s_d_id),array('mixing_status'=>"Mixed"));
                       }else{
                           $this->m_common->update_row('tbl_production_schedule_details',array('id'=>$s_d_id),array('mixing_status'=>"Mixed"));
                           $this->m_common->update_row('tbl_production_schedule_details',array('id'=>$pre_mixing_info[0]['schedule_d_id']),array('mixing_status'=>"Pending"));
                       }
            
                  redirect_with_msg('production_mixing', 'Successfully Inserted');
             }
         }else{
              redirect_with_msg('Production_mixing/edit_production_mixing/'.$id, 'Please fill the form and submit');
         }
    }
    
    
  function details_production_mixing($id=false,$print=false) {
        $branch_id= $this->session->userdata('companyId');
        $this->menu = 'production';
        $this->sub_menu = 'production';
        $this->sub_inner_menu = 'production_mixing';
        $this->titlebackend("Production Mixing");
             
      //  $sql="select dod.*,do.delivery_no,do.delivery_order_date,do.project_name,c.c_name,c.c_short_name,sp.product_name,sp.measurement_unit from tbl_delivery_order_details dod left join tbl_sales_products sp on dod.s_item_id=sp.product_id left join tbl_delivery_orders do on dod.do_id=do.do_id left join tbl_sales_orders so on do.o_id=so.o_id left join  tbl_sales_quotation q on so.q_id=q.q_id left join  tbl_customers c on q.customer_id=c.id where do.do_status='Approved' and do.is_active=1 ";
        $sql="select tpsd.*,tdo.delivery_no,tsp.product_name from tbl_production_schedule_details tpsd left join tbl_delivery_orders tdo on tpsd.do_id=tdo.do_id left join tbl_sales_products tsp on tpsd.product_id=tsp.product_id where tpsd.mixing_status='Pending'";
        $data['details_schedule']=$this->m_common->customeQuery($sql);
        $sql = "select pm.*,sp.measurement_unit,sp.product_name,d.project_name,d.contact_person,d.contact_no,d.shipping_address,d.delivery_no,d.delivery_order_date,pm.created_date,so.order_no,so.sale_order_date,c.c_name,c.c_contact_person,c.c_mobile_no,c.c_contact_address from tbl_production_mixing pm JOIN tbl_production_schedule_details psd on pm.schedule_d_id=psd.id 
JOIN tbl_sales_products sp on psd.product_id=sp.product_id 
JOIN tbl_delivery_orders d on psd.do_id=d.do_id
JOIN tbl_sales_orders so on d.o_id=so.o_id
JOIN tbl_customers c on so.customer_id=c.id
where pm.pm_id=".$id;
       // $data['mixing_info']=$this->m_common->get_row_array('tbl_production_mixing',array('pm_id'=>$id),'*');
        $data['mixing_info']=$this->m_common->customeQuery($sql);
        $sql="select tpmd.*,i.item_name from tbl_production_mixing_details tpmd left join items i on tpmd.item_id=i.id where tpmd.pm_id=".$id;
        $data['mixing_details_info']=$this->m_common->customeQuery($sql);
        if(!empty($print)){
         //   $html=$this->load->view('production_mixing/v_print_production_mixing',$data,true);
            $html=$this->load->view('production_mixing/print_product_mixing_sheet',$data,true);
            echo $html;exit;
            
        }else{
            $this->load->view('production_mixing/v_details_production_mixing',$data);
        }
    }
    
  function delete_production_mixing($id) {
        $insertData=array();
        $employee_id = $this->session->userdata('employeeId');
        $pre_mixing_info=$this->m_common->get_row_array('tbl_production_mixing',array('pm_id'=>$id),'*');
        
        if(!empty($id)) {
            if($pre_mixing_info[0]['status']=="Approved"){
                $insertData['deleted_by']=$employee_id;
                $insertData['is_active']=0;
                $insertData['deleted_date']=date('Y-m-d');
                $insertData['deleted_date_time']=date("Y-m-d h:i:sa");
                $result=$this->m_common->update_row('tbl_production_mixing', array('pm_id'=>$id),$insertData);
            }else{
                $result=$this->m_common->delete_row('tbl_production_mixing', array('pm_id'=>$id));
                $this->m_common->update_row('tbl_production_schedule_details', array('id'=>$pre_mixing_info[0]['schedule_d_id']),array('mixing_status'=>"Pending"));
            }
            if(!empty($result)) {    
                if($pre_mixing_info[0]['status']=="Approved"){
                    $this->m_common->update_row('tbl_production_mixing_details', array('pm_id'=>$id),array('is_active'=>0));
                }else{
                    $this->m_common->delete_row('tbl_production_mixing_details', array('pm_id'=>$id));
                }
                redirect_with_msg('production_mixing', 'Successfully Deleted');
            } else {
                redirect_with_msg('production_mixing', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('production_mixing', 'Please click on delete button');
        }
    }
    
  function forwardProductionMixing($id) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'production_mixing';
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $production_mixing_info = $this->m_common->get_row_array("tbl_production_mixing", array('pm_id' => $id), "*");
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $production_mixing_info[0]['created_by']), "*");
        $approver_data = fetch_approver(13,58, $approvers_info); //
       
        if ($employee_id == $approver_data[0]) {
            $this->m_common->update_row('tbl_production_mixing', array('pm_id' => $id), array('status' =>'Forward-By-First-Approver', 'approver_id' =>$approver_data[1],'approved_by' =>$employee_id,'approver_name' =>$approver_name));
            $array = array(
                "employee_id" => $approver_data[1],
                "title" => "Product mixing approval",
                "notice" => "Please approve the product mixing",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "production_mixing/details_production_mixing/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        if ($employee_id == $approver_data[1]) {
            $this->m_common->update_row('tbl_production_mixing', array('pm_id' => $id), array('status' => 'Forward-By-Second-Approver', 'approver_id' =>$approver_data[2],'approved_by' =>$employee_id,'approver_name' =>$approver_name));
            $array = array(
                "employee_id" =>$approver_data[2],
                "title" => "Product mixing approval",
                "notice" => "Please approve the product mixing",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "production_mixing/details_production_mixing/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        if($employee_id ==$approver_data[2]) {
            $this->m_common->update_row('tbl_production_mixing', array('pm_id' => $id), array('status' => 'Forward-By-First-Approver', 'approver_id' =>$approver_data[3],'approved_by' =>$employee_id,'approver_name' =>$approver_name));
            $array = array(
                "employee_id" => $approver_data[3],
                "title" => "Product mixing approval",
                "notice" => "Please approve the production mixing",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "production_mixing/details_production_mixing/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }
        
        redirect_with_msg('production_mixing', 'Forward Successfull');
    }
     
   function rejectProductionMixing($id) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'production_mixing';
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $production_mixing_info = $this->m_common->get_row_array("tbl_production_mixing", array('pm_id' => $id), "*");
        $production_mixing_details_info = $this->m_common->get_row_array("tbl_production_mixing_details", array('pm_id' => $id), "*");
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $production_mixing_info[0]['created_by']), "*");
        $approver_data = fetch_approver(13,58, $approvers_info); //
        if($user_type==1){
            $this->m_common->update_row('tbl_production_mixing', array('pm_id' => $id), array('status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
            
            $array = array(
                "employee_id" =>$production_mixing_info[0]['created_by'],
                "title" => "Product mixing approval",
                "notice" => "The production mixing is rejected by admin",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "production_mixing/details_production_mixing/".$id
            );
           $this->m_common->insert_row("notice", $array);
           
            
        }else{
            if ($employee_id == $approver_data[0]) {
                $this->m_common->update_row('tbl_production_mixing', array('pm_id' => $id), array('status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$production_mixing_info[0]['created_by'],
                    "title" => "Product mixing approval",
                    "notice" => "The production mixing is rejected by first approver",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "production_mixing/details_production_mixing/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[1]) {
                $this->m_common->update_row('tbl_production_mixing', array('pm_id' => $id), array('status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$production_mixing_info[0]['created_by'],
                    "title" => "Product Mixing approval",
                    "notice" => "The production_mixing is rejected by second approver",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "production_mixing/details_production_mixing/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[2]) {
                $this->m_common->update_row('tbl_production_mixing', array('pm_id' => $id), array('status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$production_mixing_info[0]['created_by'],
                    "title" => "Product Mixing approval",
                    "notice" => "The production_mixing is rejected by third approver",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "production_mixing/details_production_mixing/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[3]) {
                $this->m_common->update_row('tbl_production_mixing', array('pm_id' => $id), array('status' =>'Rejected', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                $array = array(
                    "employee_id" =>$production_mixing_info[0]['created_by'],
                    "title" => "Product mixing approval",
                    "notice" => "The production mixing is rejected by forth approver",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "production_mixing/details_production_mixing/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
        }     
        redirect_with_msg('production_mixing', 'Rejected Successfully');
    }
     
   function approveProductionMixing($id) {
        $branch_id= $this->session->userdata('companyId');  
        $this->menu = 'general_store';
        $this->sub_menu = 'procurement';
        $this->sub_inner_menu = 'production_mixing';
        $employee_id = $this->session->userdata('employeeId');
        $user_type = $this->session->userdata('user_type');
        $user_id = $this->session->userdata('user_id');
        $production_mixing_info = $this->m_common->get_row_array("tbl_production_mixing", array('pm_id' => $id), "*");
        $production_mixing_details_info = $this->m_common->get_row_array("tbl_production_mixing_details", array('pm_id' => $id), "*");
        $approver = $this->m_common->get_row_array('v_employees', array('id' => $employee_id), '*');
        $approver_name = $approver[0]['name'] . "(" . $approver[0]['designation_name'] . ")";
        $approvers_info = $this->m_common->get_row_array("users", array('employeeId' => $employee_id), "*");
        $approver_data = fetch_approver(13,58, $approvers_info); //
        if($user_type==1){
            $this->m_common->update_row('tbl_production_mixing', array('pm_id' => $id), array('status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
         
            $array = array(
                "employee_id" =>$production_mixing_info[0]['created_by'],
                "title" => "Product mixing approval",
                "notice" => "The production mixing is approved",
                "create_date" => date('Y-m-d H:i:s'),
                "date" => date('Y-m-d'),
                "status" => "Unseen",
                "url" => "production_mixing/details_production_mixing/".$id
            );
            $this->m_common->insert_row("notice", $array);
        }else{
            if ($employee_id == $approver_data[0]) {
                $this->m_common->update_row('tbl_production_mixing', array('pm_id' => $id), array('status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                
                $array = array(
                    "employee_id" =>$production_mixing_info[0]['created_by'],
                    "title" => "Product mixing approval",
                    "notice" => "The production mixing is approved",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "production_mixing/details_production_mixing/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[1]) {
                $this->m_common->update_row('tbl_production_mixing', array('pm_id' => $id), array('status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
                
                $array = array(
                    "employee_id" =>$production_mixing_info[0]['created_by'],
                    "title" => "Product mixing approval",
                    "notice" => "The production mixing is approved",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "production_mixing/details_production_mixing/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[2]) {
               $this->m_common->update_row('tbl_production_mixing', array('pm_id' => $id), array('status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
               
               $array = array(
                    "employee_id" =>$production_mixing_info[0]['created_by'],
                    "title" => "Product mixing approval",
                    "notice" => "The production mixing is approved",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "production_mixing/details_production_mixing/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
            if ($employee_id == $approver_data[3]) {
               $this->m_common->update_row('tbl_production_mixing', array('pm_id' => $id), array('status' =>'Approved', 'approver_id' =>'','approved_by' =>$employee_id,'approver_name' =>$approver_name));
               
                $array = array(
                    "employee_id" =>$production_mixing_info[0]['created_by'],
                    "title" => "Product mixing approval",
                    "notice" => "The production mixing is approved",
                    "create_date" => date('Y-m-d H:i:s'),
                    "date" => date('Y-m-d'),
                    "status" => "Unseen",
                    "url" => "production_mixing/details_production_mixing/".$id
                );
                $this->m_common->insert_row("notice", $array);
            }
        }     
        redirect_with_msg('production_mixing', 'Approved Successfully');
    }
    
    function get_item_material(){
        $branch_id= $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
        $schedule_details_id=$this->input->post('schedule_details_id');
        $sql="select tpsd.*,tso.q_id from tbl_production_schedule_details tpsd left join tbl_delivery_orders tdo on tpsd.do_id=tdo.do_id left join tbl_sales_orders tso on tdo.o_id=tso.o_id  where tpsd.id=".$schedule_details_id;
        $q_p_info=$this->m_common->customeQuery($sql);
        $data['casting_info']=$q_p_info;
        if(!empty($q_p_info[0]['q_id'])){
        $q_p_sql="select * from tbl_sales_quotation_details where q_id=".$q_p_info[0]['q_id']." and product_id=".$q_p_info[0]['product_id'];
        $costing_info=$this->m_common->customeQuery($q_p_sql);
        $m_sql="select tspmc.*,items.item_name from tbl_sales_product_material_cost tspmc left join items on tspmc.m_id=items.id where tspmc.product_cost_id=".$costing_info[0]['product_cost_id'];
        $data['mixing_info']=$this->m_common->customeQuery($m_sql);
        $q_p_info[0]['mu_name'] = $costing_info[0]['mu_name'];
        $data['schedule_info']=$q_p_info;
        }else{
        $m_sql="select mp.*,sp.measurement_unit from tbl_mixing_products mp left join tbl_sales_products sp on mp.product_id=sp.product_id where mp.is_active=1 and  mp.product_id=".$q_p_info[0]['product_id'];
        $mixing_product=$this->m_common->customeQuery($m_sql);
        //$data['mixing_info']=$mixing_product;
        if(!empty($mixing_product[0]['mixing_id'])){
           // $sql="select mpm.*,items.item_name,items.meas_unit from tbl_mixing_product_materials mpm left join items  on mpm.m_id=items.id where mpm.mixing_id=".$mixing_product[0]['mixing_id'];
            $sql="select mpm.*,mpm.c_mu as mu,items.item_name,tmu.meas_unit from tbl_mixing_product_materials mpm left join items  on mpm.m_id=items.id left join tbl_measurement_unit as tmu on mpm.mu_id=tmu.id where mpm.is_active=1 and mpm.mixing_id=".$mixing_product[0]['mixing_id'];
            $data['mixing_info']=$this->m_common->customeQuery($sql);
        }else{
            $data['mixing_info']='';
        }
        $q_p_info[0]['mu_name'] = $mixing_product[0]['measurement_unit'];
        $data['schedule_info']=$q_p_info;
        }
        echo json_encode($data);
        
    } 
    function get_sales_order_item(){
        $branch_id= $this->session->userdata('companyId');
        $this->setOutputMode(NORMAL);
        $o_id=$this->input->post('o_id');
       // $data['sales_order_info']=$this->m_common->get_row_array('tbl_sales_orders',array('o_id'=>$o_id),'*');
        $order_sql='select so.*,c.c_short_name,c.id from tbl_sales_orders so left join tbl_sales_quotation sq on so.q_id=sq.q_id left join tbl_customers c on sq.customer_id=c.id where so.o_id='.$o_id;
        $data['sales_order_info']=$this->m_common->customeQuery($order_sql);
      //  $sql="select d.*,i.s_item_name from tbl_sales_order_details d left join tbl_sales_items i on d.s_item_id=i.s_item_id where d.is_active=1 and d.o_id=".$o_id;
        $sql="select d.*,i.product_name,i.measurement_unit from tbl_sales_order_details d left join tbl_sales_products i on d.product_id=i.product_id where d.is_active=1 and d.o_id=".$o_id;
        $data['item_list']=$this->m_common->customeQuery($sql);
        //$data['order_code']=$this->m_common->get_row_array('tbl_delivery_orders_code',array('customer_id'=>$data['sales_order_info'][0]['id']),'*','',1,'id','DESC');
        $data['order_code']=$this->m_common->get_row_array('tbl_delivery_orders_code',array('customer_id'=>$data['sales_order_info'][0]['id'],'unit_id'=>$branch_id),'*','',1,'id','DESC');
        echo json_encode($data);
     }
     
     
     
    
    
   
   
     
   

}






