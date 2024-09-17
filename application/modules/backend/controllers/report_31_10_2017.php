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
        if (!$this->is_logged_in($this->session->userdata('logged_in'))) {
            redirect_with_msg('backend/login', 'Please Login to see this page');
        }
        $this->load->model("m_common");
        $this->setTemplateFile('template');
        $this->user_id = $this->session->userdata('user_id');
        $this->rank = $this->session->userdata('rank');
    }

    function index() {
        $this->menu = 'report';
        $this->sub_menu = 'report';
        $this->titlebackend("Report");

        $this->load->view('report/report_list');
    }
    
    function storeLedger(){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        
        $postData = $this->input->post();
        if(!empty($postData)){
           $item=$this->input->post('item');
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $from_date=date('Y-m-d',strtotime($f_date));
           $too_date=date('Y-m-d',strtotime($to_date));
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items','','*');
           if($item=="all"){
              $data['items']=$this->m_common->get_row_array('items','','*');
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
                
                
                $sql='Select sum(return_qty) as is_ret_qty,sum(return_value) as is_ret_value from issue_return_details where ir_date>="'.$from_date.'" and ir_date<="'.$too_date.'" and item_id='.$item_info['id'].' and ir_d_status="received" ';
                $issue_return_qty=$this->m_common->customeQuery($sql);
                if(!empty($issue_return_qty[0]['is_ret_qty'])){
                     $data['items'][$key]['issue_return_qty']=$issue_return_qty[0]['is_ret_qty'];
                     $data['items'][$key]['issue_return_value']=$issue_return_qty[0]['is_ret_value'];
                }else{
                    $data['items'][$key]['issue_return_qty']=0;
                    $data['items'][$key]['issue_return_value']=0;
                }
                
                $sql='Select sum(receive_qty) as mrr_receive_qty,sum(receive_value) as mrr_receive_value from mrr_return_receive_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and item_id='.$item_info['id'].' and mrr_rr_d_status="received" ';
                $issue_return_qty=$this->m_common->customeQuery($sql);
                if(!empty($issue_return_qty[0]['mrr_receive_qty'])){
                     $data['items'][$key]['mrr_receive_qty']=$issue_return_qty[0]['mrr_receive_qty'];
                     $data['items'][$key]['mrr_receive_value']=$issue_return_qty[0]['mrr_receive_value'];
                }else{
                    $data['items'][$key]['mrr_receive_qty']=0;
                    $data['items'][$key]['mrr_receive_value']=0;
                }
                
                $data['items'][$key]['return_receive_qty']=$data['items'][$key]['issue_return_qty']+$data['items'][$key]['mrr_receive_qty'];
                $data['items'][$key]['return_receive_value']= $data['items'][$key]['issue_return_value']+$data['items'][$key]['mrr_receive_value'];

               

                $avilable_quantity=$data['items'][$key]['receive_qty']+$data['items'][$key]['issue_return_qty']+ $data['items'][$key]['mrr_receive_qty'];
                $avilable_value=$data['items'][$key]['receive_value']+ $data['items'][$key]['issue_return_value']+$data['items'][$key]['mrr_receive_value'];
                $data['items'][$key]['total_rec_ret_qty']=$data['items'][$key]['receive_qty']+$data['items'][$key]['issue_return_qty'];
                $data['items'][$key]['total_rec_ret_value']=$data['items'][$key]['receive_value']+ $data['items'][$key]['issue_return_value'];



                $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where issue_date>="'.$from_date.'" and issue_date<="'.$too_date.'" and item_id='.$item_info['id'].' and issue_status="issued" ';
                $issue_qty=$this->m_common->customeQuery($sql);
                if(!empty($issue_qty[0]['issue_qty'])){
                     $data['items'][$key]['issue_qty']=$issue_qty[0]['issue_qty'];
                     $data['items'][$key]['issue_value']=$issue_qty[0]['issue_value'];
                }else{
                    $data['items'][$key]['issue_qty']=0; 
                    $data['items'][$key]['issue_value']=0;
                }
                
                
                $sql='Select sum(return_qty) as ret_qty,sum(return_value) as ret_value from return_receive_details where rr_date>="'.$from_date.'" and rr_date<="'.$too_date.'" and item_id='.$item_info['id'].' and rr_d_status="returned" ';
                $return_qty=$this->m_common->customeQuery($sql);
                if(!empty($return_qty[0]['ret_qty'])){
                     $data['items'][$key]['return_qty']=$return_qty[0]['ret_qty'];
                     $data['items'][$key]['return_value']=$return_qty[0]['ret_value'];
                }else{
                    $data['items'][$key]['return_qty']=0; 
                    $data['items'][$key]['return_value']=0;
                }



              



                $total_issue_qty=$data['items'][$key]['issue_qty']+ $data['items'][$key]['return_qty']; 
                $total_issue_value=$data['items'][$key]['issue_value']+$data['items'][$key]['return_value'];
                $data['items'][$key]['total_issue_qty']=$data['items'][$key]['issue_qty']+ $data['items'][$key]['return_qty']; 
                $data['items'][$key]['total_issue_value']= $data['items'][$key]['issue_value']+$data['items'][$key]['return_value'];
                
                $balance=$avilable_quantity-$total_issue_qty; 
                $data['items'][$key]['balance']=$avilable_quantity-$total_issue_qty; 
                $data['items'][$key]['value']=$avilable_value-$total_issue_value; 



            }

             $data['data']=$data['items'];
               
          
        }else{
           $item='';
           $f_date='';
           $to_date='';
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items','','*'); 
        }
        $this->load->view('report/store_ledger',$data);
    }
    
    
    
    
    
    function receiveReport(){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        
        $postData = $this->input->post();
        if(!empty($postData)){
            
          $report_type=$this->input->post('report_type');  
          
            
           $item=$this->input->post('item');
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $from_date=date('Y-m-d',strtotime($f_date));
           $too_date=date('Y-m-d',strtotime($to_date));
           $data['report_type']=$report_type;
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*');
           if($report_type=="summary"){
                if($item=="all"){
                   $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*');
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
                  $sql='Select * from material_receive_requisition_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and mrr_d_status="received" ';
               }else{
                  $sql='Select * from material_receive_requisition_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and item_id='.$item.' and mrr_d_status="received" ';
               }
               $receive_qty=$this->m_common->customeQuery($sql);
               $data['data']=$receive_qty;
               
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
        $this->load->view('report/receive_report',$data);
    }
    
    
    
    
     function issueReturnReceiveReport(){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        
        $postData = $this->input->post();
        if(!empty($postData)){
            
          $report_type=$this->input->post('report_type');  
          
            
           $item=$this->input->post('item');
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $from_date=date('Y-m-d',strtotime($f_date));
           $too_date=date('Y-m-d',strtotime($to_date));
           $data['report_type']=$report_type;
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*');
           if($report_type=="summary"){
                if($item=="all"){
                   $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*');
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
                   $sql='Select * from issue_return_details where ir_date>="'.$from_date.'" and ir_date<="'.$too_date.'" and ir_d_status="received" ';
               }else{
                   $sql='Select * from issue_return_details where ir_date>="'.$from_date.'" and ir_date<="'.$too_date.'" and item_id='.$item.' and ir_d_status="received" ';
               }
               $receive_qty=$this->m_common->customeQuery($sql);
               $data['data']=$receive_qty;
               
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
        $this->load->view('report/issue_return_receive_report',$data);
    }
    
    
     function mrrReturnReceiveReport(){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        
        $postData = $this->input->post();
        if(!empty($postData)){
            
          $report_type=$this->input->post('report_type');  
          
            
           $item=$this->input->post('item');
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $from_date=date('Y-m-d',strtotime($f_date));
           $too_date=date('Y-m-d',strtotime($to_date));
           $data['report_type']=$report_type;
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*');
           if($report_type=="summary"){
                if($item=="all"){
                   $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*');
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
                    $sql='Select * from mrr_return_receive_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and mrr_rr_d_status="received" ';
               }else{
                   $sql='Select * from mrr_return_receive_details where receive_date>="'.$from_date.'" and receive_date<="'.$too_date.'" and item_id='.$item.' and mrr_rr_d_status="received" ';
               }
               $receive_qty=$this->m_common->customeQuery($sql);
               $data['data']=$receive_qty;
               
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
        $this->load->view('report/mrr_return_receive_report',$data);
    }
    
    
      function issueReport(){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        
        $postData = $this->input->post();
        if(!empty($postData)){
            
          $report_type=$this->input->post('report_type');  
          
            
           $item=$this->input->post('item');
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $from_date=date('Y-m-d',strtotime($f_date));
           $too_date=date('Y-m-d',strtotime($to_date));
           $data['report_type']=$report_type;
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*');
           if($report_type=="summary"){
                if($item=="all"){
                   $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*');
                }else{
                    $data['items']=$this->m_common->get_row_array('items',array('id'=>$item),'*'); 
                }

                 foreach($data['items'] as $key=>$item_info){
                    $sql='Select sum(issue_quality) as issue_qty,sum(issue_value) as issue_value from issue_session_details where issue_date>="'.$from_date.'" and issue_date<="'.$too_date.'" and item_id='.$item_info['id'].' and issue_status="issued" ';
                    $issue_qty=$this->m_common->customeQuery($sql);
                    if(!empty($issue_qty[0]['issue_qty'])){
                         $data['items'][$key]['issue_qty']=$issue_qty[0]['issue_qty'];
                         $data['items'][$key]['issue_value']=$issue_qty[0]['issue_value'];
                    }else{
                        $data['items'][$key]['issue_qty']=0; 
                        $data['items'][$key]['issue_value']=0;
                    }


                 }

                  $data['data']=$data['items'];
           }else{
               if($item=="all"){
                  $sql='Select * from issue_session_details where issue_date>="'.$from_date.'" and issue_date<="'.$too_date.'" and issue_status="issued" ';
               }else{
                   $sql='Select * from issue_session_details where issue_date>="'.$from_date.'" and issue_date<="'.$too_date.'" and item_id='.$item.' and issue_status="issued" ';
               }
               $issued_qty=$this->m_common->customeQuery($sql);
               $data['data']=$issued_qty;
               
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
        $this->load->view('report/issue_report',$data);
    }
    
    
    
      function returnReport(){
        $this->menu = 'general_store';
        $this->sub_menu = 'report';
        
        $postData = $this->input->post();
        if(!empty($postData)){
            
          $report_type=$this->input->post('report_type');  
          
            
           $item=$this->input->post('item');
           $f_date=$this->input->post('from_date');
           $to_date=$this->input->post('to_date');
           $from_date=date('Y-m-d',strtotime($f_date));
           $too_date=date('Y-m-d',strtotime($to_date));
           $data['report_type']=$report_type;
           $data['item_id']=$item;
           $data['f_date']=$f_date;
           $data['to_date']=$to_date;
           $data['allitems']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*');
           if($report_type=="summary"){
                if($item=="all"){
                   $data['items']=$this->m_common->get_row_array('items',array('item_type'=>"Consumable"),'*');
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
                    $sql='Select * from return_receive_details where rr_date>="'.$from_date.'" and rr_date<="'.$too_date.'" and rr_d_status="returned" ';
               }else{
                    $sql='Select * from return_receive_details where rr_date>="'.$from_date.'" and rr_date<="'.$too_date.'" and item_id='.$item.' and rr_d_status="returned" ';
               }
               $issued_qty=$this->m_common->customeQuery($sql);
               $data['data']=$issued_qty;
               
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
        $this->load->view('report/return_report',$data);
    }

    

}
