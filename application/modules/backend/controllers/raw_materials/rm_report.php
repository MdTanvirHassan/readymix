<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rm_report extends Site_Controller {

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
        $this->menu = 'fg';
        $this->sub_menu = 'production_receive';
        $this->sub_inner_menu = 'production_receive';
        $this->titlebackend("Products");
       
        $data['production_receives']=$this->m_common->get_row_array('tbl_finish_good_received',array('is_active'=>1,'received_type'=>"Production"),'*');
        $this->load->view('raw_materials/rm_report/v_report_list',$data);
    }
    
    
   function rawmaterialMasterReport(){
       
       
       
       $data['all_lots']=$this->m_common->get_row_array('rm_lots',array('is_active'=>1),'*');
       if(!empty($_POST)){
            $data['lot_id']=$lot_id=$this->input->post('lot_id');
            $data['from_date']=$from_date=date('Y-m-d',strtotime($this->input->post('from_date')));
            $data['to_date']=$to_date=date('Y-m-d',strtotime($this->input->post('to_date')));
            
            if(!empty($lot_id)){
                //$data['lots']=$this->m_common->get_row_array('rm_lots',array('is_active'=>1,'id'=>$lot_id),'*');
                $l_sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_lots_details iscd 
                left join rm_lots rml on iscd.lot_id=rml.id 
                left join rm_items rmi on iscd.item_id=rmi.id 
                left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id 
                where rml.is_active=1 and iscd.lot_id=".$lot_id." group by lot_id";
                $data['lots']=$this->m_common->customeQuery($l_sql);
            }else{
                //$data['lots']=$this->m_common->get_row_array('rm_lots',array('is_active'=>1),'*');
                $l_sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_lots_details iscd
                left join rm_lots rml on iscd.lot_id=rml.id 
                left join rm_items rmi on iscd.item_id=rmi.id 
                left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id 
                where rml.is_active=1 group by lot_id";
                $data['lots']=$this->m_common->customeQuery($l_sql);
            }
            
            foreach($data['lots'] as $key=>$value){
                 $o_receive=array();
                 $or_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd 
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where rmr.mrr_date<'$from_date' and rmrd.lot_id=".$value['id'];
                 $o_receive=$this->m_common->customeQuery($or_sql);

                 $o_issue=array();
                 $o_is_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where rmi.issue_date<'$from_date' and rmid.lot_id=".$value['id'];
                 $o_issue=$this->m_common->customeQuery($o_is_sql);

                 $opening_bale_qty=$o_receive[0]['total_rb']-$o_issue[0]['total_ib'];
                 $opening_qty=$o_receive[0]['total_rq']-$o_issue[0]['total_iq'];

                 $data['lots'][$key]['opening_bale']=$opening_bale_qty;
                 $data['lots'][$key]['opening_qty']=$opening_qty;

                 $purchase=array();
                 $p_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where (rmr.mrr_date>='$from_date' and rmr.mrr_date<='$to_date') and rmrd.lot_id=".$value['id']." and rmr.mrr_type='Lc' ";
                 $purchase=$this->m_common->customeQuery($p_sql);

                 $data['lots'][$key]['purchase_bale']=$p_bale=$purchase[0]['total_rb'];
                 $data['lots'][$key]['purchase_qty']=$p_qty=$purchase[0]['total_rq'];

                 $return=array();
                 $r_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where (rmr.mrr_date>='$from_date' and rmr.mrr_date<='$to_date') and rmrd.lot_id=".$value['id']." and rmr.mrr_type='Lc' ";
                 $return=$this->m_common->customeQuery($r_sql);
                 $data['lots'][$key]['return_bale']=$r_bale=$return[0]['total_rb'];
                 $data['lots'][$key]['return_qty']=$r_qty=$return[0]['total_rq'];


                 $total_receive_bale=$purchase[0]['total_rb']+$return[0]['total_rb'];
                 $total_receive_qty=$purchase[0]['total_rq']+$return[0]['total_rq'];

                 $data['lots'][$key]['total_receive_bale']=$total_receive_bale;
                 $data['lots'][$key]['total_receive_qty']=$total_receive_qty;


                 $issue=array();
                 $issue_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where (rmi.issue_date>='$from_date' and rmi.issue_date<='$to_date') and  rmid.lot_id=".$value['id']." and rmi.issue_type='Production Issue' ";
                 $issue=$this->m_common->customeQuery($issue_sql);
                 $data['lots'][$key]['consumption_bale']=$i_bale=$issue[0]['total_ib'];
                 $data['lots'][$key]['consumption_qty']=$i_qty=$issue[0]['total_iq'];


                 $sales=array();
                 $sale_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where (rmi.issue_date>='$from_date' and rmi.issue_date<='$to_date') and  rmid.lot_id=".$value['id']." and rmi.issue_type='Sales' ";
                 $sales=$this->m_common->customeQuery($sale_sql);
                 $data['lots'][$key]['sale_bale']=$s_bale=$sales[0]['total_ib'];
                 $data['lots'][$key]['sale_qty']=$s_qty=$sales[0]['total_iq'];

                 $total_issue_bale=$issue[0]['total_ib']+$sales[0]['total_ib'];
                 $total_issue_qty=$issue[0]['total_iq']+$sales[0]['total_iq'];

                 $data['lots'][$key]['total_issue_bale']=$total_issue_bale;
                 $data['lots'][$key]['total_issue_qty']=$total_issue_qty;

                 $data['lots'][$key]['closing_bale']=$c_bale=$opening_bale_qty+$total_receive_bale-$total_issue_bale;
                 $data['lots'][$key]['closing_qty']=$c_qty=$opening_qty+$total_receive_qty-$total_issue_qty;

                 if(empty($opening_qty) && empty($p_qty) && empty($r_qty) && empty($i_qty) && empty($s_qty) && empty($c_qty) ){
                     unset($data['lots'][$key]);
                 }


            }
       }else{
          $data['lot_id']=''; 
          $data['from_date']=$from_date=date('Y-m-01');
          $data['to_date']=$to_date=date('Y-m-t');
          
          //$data['lots']=$this->m_common->get_row_array('rm_lots',array('is_active'=>1),'*');
          
          $l_sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_lots_details iscd
          left join rm_lots rml on iscd.lot_id=rml.id 
          left join rm_items rmi on iscd.item_id=rmi.id 
          left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id 
          where rml.is_active=1 group by lot_id";
          $data['lots']=$this->m_common->customeQuery($l_sql);
          
            foreach($data['lots'] as $key=>$value){
                 $o_receive=array();
                 $or_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id
                 where rmr.mrr_date<'$from_date' and rmrd.lot_id=".$value['id'];
                 $o_receive=$this->m_common->customeQuery($or_sql);

                 $o_issue=array();
                 $o_is_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where rmi.issue_date<'$from_date' and rmid.lot_id=".$value['id'];
                 $o_issue=$this->m_common->customeQuery($o_is_sql);

                 $opening_bale_qty=$o_receive[0]['total_rb']-$o_issue[0]['total_ib'];
                 $opening_qty=$o_receive[0]['total_rq']-$o_issue[0]['total_iq'];

                 $data['lots'][$key]['opening_bale']=$opening_bale_qty;
                 $data['lots'][$key]['opening_qty']=$opening_qty;

                 $purchase=array();
                 $p_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where (rmr.mrr_date>='$from_date' and rmr.mrr_date<='$to_date') and rmrd.lot_id=".$value['id']." and rmr.mrr_type='Lc' ";
                 $purchase=$this->m_common->customeQuery($p_sql);

                 $data['lots'][$key]['purchase_bale']=$p_bale=$purchase[0]['total_rb'];
                 $data['lots'][$key]['purchase_qty']=$p_qty=$purchase[0]['total_rq'];

                 $return=array();
                 $r_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where (rmr.mrr_date>='$from_date' and rmr.mrr_date<='$to_date') and rmrd.lot_id=".$value['id']." and rmr.mrr_type='Lc' ";
                 $return=$this->m_common->customeQuery($r_sql);
                 $data['lots'][$key]['return_bale']=$r_bale=$return[0]['total_rb'];
                 $data['lots'][$key]['return_qty']=$r_qty=$return[0]['total_rq'];


                 $total_receive_bale=$purchase[0]['total_rb']+$return[0]['total_rb'];
                 $total_receive_qty=$purchase[0]['total_rq']+$return[0]['total_rq'];

                 $data['lots'][$key]['total_receive_bale']=$total_receive_bale;
                 $data['lots'][$key]['total_receive_qty']=$total_receive_qty;


                 $issue=array();
                 $issue_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where (rmi.issue_date>='$from_date' and rmi.issue_date<='$to_date') and  rmid.lot_id=".$value['id']." and rmi.issue_type='Production Issue' ";
                 $issue=$this->m_common->customeQuery($issue_sql);
                 $data['lots'][$key]['consumption_bale']=$i_bale=$issue[0]['total_ib'];
                 $data['lots'][$key]['consumption_qty']=$i_qty=$issue[0]['total_iq'];


                 $sales=array();
                 $sale_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where (rmi.issue_date>='$from_date' and rmi.issue_date<='$to_date') and  rmid.lot_id=".$value['id']." and rmi.issue_type='Sales' ";
                 $sales=$this->m_common->customeQuery($sale_sql);
                 $data['lots'][$key]['sale_bale']=$s_bale=$sales[0]['total_ib'];
                 $data['lots'][$key]['sale_qty']=$s_qty=$sales[0]['total_iq'];

                 $total_issue_bale=$issue[0]['total_ib']+$sales[0]['total_ib'];
                 $total_issue_qty=$issue[0]['total_iq']+$sales[0]['total_iq'];

                 $data['lots'][$key]['total_issue_bale']=$total_issue_bale;
                 $data['lots'][$key]['total_issue_qty']=$total_issue_qty;

                 $data['lots'][$key]['closing_bale']=$c_bale=$opening_bale_qty+$total_receive_bale-$total_issue_bale;
                 $data['lots'][$key]['closing_qty']=$c_qty=$opening_qty+$total_receive_qty-$total_issue_qty;
                 
                 if(empty($opening_qty) && empty($p_qty) && empty($r_qty) && empty($i_qty) && empty($s_qty) && empty($c_qty) ){
                     unset($data['lots'][$key]);
                 }



            } 
       }
       $this->load->view('raw_materials/rm_report/v_rm_master_report',$data);
   }
     
    
   function rawmaterialDailyTransactionReport(){
       
       
       
       $data['all_lots']=$this->m_common->get_row_array('rm_lots',array('is_active'=>1),'*');
       if(!empty($_POST)){
            $data['lot_id']=$lot_id=$this->input->post('lot_id');
            $data['from_date']=$from_date=date('Y-m-d',strtotime($this->input->post('from_date')));
            $data['to_date']=$to_date=date('Y-m-d',strtotime($this->input->post('to_date')));
            
            if(!empty($lot_id)){
                //$data['lots']=$this->m_common->get_row_array('rm_lots',array('is_active'=>1,'id'=>$lot_id),'*');
                $l_sql="select iscd.*,ilc.lc_no,ilc.date,s.SUP_NAME,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_lots_details iscd
                left join rm_lots rml on iscd.lot_id=rml.id 
                left join import_lc ilc on rml.lc_id=ilc.lc_id
                left join supplier s on ilc.sup_id=s.ID
                left join rm_items rmi on iscd.item_id=rmi.id 
                left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id 
                where rml.is_active=1 and iscd.lot_id=".$lot_id." group by lot_id";
                $data['lots']=$this->m_common->customeQuery($l_sql);
            }else{
                //$data['lots']=$this->m_common->get_row_array('rm_lots',array('is_active'=>1),'*');
                $l_sql="select iscd.*,ilc.lc_no,ilc.date,s.SUP_NAME,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_lots_details iscd
                left join rm_lots rml on iscd.lot_id=rml.id 
                left join import_lc ilc on rml.lc_id=ilc.lc_id
                left join supplier s on ilc.sup_id=s.ID
                left join rm_items rmi on iscd.item_id=rmi.id 
                left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id 
                where rml.is_active=1 group by lot_id";
                $data['lots']=$this->m_common->customeQuery($l_sql);
            }
            
            foreach($data['lots'] as $key=>$value){
                
                $cum_date=date('Y-m-d',strtotime('-1 day',strtotime($from_date)));
                
                 $cum_receive=array();
                 $cum_r_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd 
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where rmr.mrr_date='$cum_date' and rmrd.lot_id=".$value['id'];
                 $cum_receive=$this->m_common->customeQuery($cum_r_sql);
                 
                 $data['lots'][$key]['cum_receive_bale']=$cum_receive[0]['total_rb'];
                 $data['lots'][$key]['cum_receive_qty']=$cum_receive[0]['total_rq'];
                 
                 
                 $cum_issue=array();
                 $cum_i_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where rmi.issue_date='$cum_date' and rmid.lot_id=".$value['id'];
                 $cum_issue=$this->m_common->customeQuery($cum_i_sql);
                 
                 $data['lots'][$key]['cum_issue_bale']=$cum_issue[0]['total_ib'];
                 $data['lots'][$key]['cum_issue_qty']=$cum_issue[0]['total_iq'];
                 
                 
                
                
                 $o_receive=array();
                 $or_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd 
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where rmr.mrr_date<'$from_date' and rmrd.lot_id=".$value['id'];
                 $o_receive=$this->m_common->customeQuery($or_sql);

                 $o_issue=array();
                 $o_is_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where rmi.issue_date<'$from_date' and rmid.lot_id=".$value['id'];
                 $o_issue=$this->m_common->customeQuery($o_is_sql);

                 $opening_bale_qty=$o_receive[0]['total_rb']-$o_issue[0]['total_ib'];
                 $opening_qty=$o_receive[0]['total_rq']-$o_issue[0]['total_iq'];

                 $data['lots'][$key]['opening_bale']=$opening_bale_qty;
                 $data['lots'][$key]['opening_qty']=$opening_qty;

                 $purchase=array();
                 $p_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where rmr.mrr_date='$from_date' and rmrd.lot_id=".$value['id']." and rmr.mrr_type='Lc' ";
                 $purchase=$this->m_common->customeQuery($p_sql);

                 $data['lots'][$key]['purchase_bale']=$p_bale=$purchase[0]['total_rb'];
                 $data['lots'][$key]['purchase_qty']=$p_qty=$purchase[0]['total_rq'];

                 $return=array();
                 $r_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where rmr.mrr_date='$from_date' and rmrd.lot_id=".$value['id']." and rmr.mrr_type='Lc' ";
                 $return=$this->m_common->customeQuery($r_sql);
                 $data['lots'][$key]['return_bale']=$r_bale=$return[0]['total_rb'];
                 $data['lots'][$key]['return_qty']=$r_qty=$return[0]['total_rq'];


                 $total_receive_bale=$purchase[0]['total_rb']+$return[0]['total_rb'];
                 $total_receive_qty=$purchase[0]['total_rq']+$return[0]['total_rq'];

                 $data['lots'][$key]['total_receive_bale']=$total_receive_bale;
                 $data['lots'][$key]['total_receive_qty']=$total_receive_qty;


                 $issue=array();
                 $issue_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where rmi.issue_date='$from_date' and  rmid.lot_id=".$value['id']." and rmi.issue_type='Production Issue' ";
                 $issue=$this->m_common->customeQuery($issue_sql);
                 $data['lots'][$key]['consumption_bale']=$i_bale=$issue[0]['total_ib'];
                 $data['lots'][$key]['consumption_qty']=$i_qty=$issue[0]['total_iq'];


                 $sales=array();
                 $sale_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where rmi.issue_date='$from_date' and  rmid.lot_id=".$value['id']." and rmi.issue_type='Sales' ";
                 $sales=$this->m_common->customeQuery($sale_sql);
                 $data['lots'][$key]['sale_bale']=$s_bale=$sales[0]['total_ib'];
                 $data['lots'][$key]['sale_qty']=$s_qty=$sales[0]['total_iq'];

                 $total_issue_bale=$issue[0]['total_ib']+$sales[0]['total_ib'];
                 $total_issue_qty=$issue[0]['total_iq']+$sales[0]['total_iq'];

                 $data['lots'][$key]['total_issue_bale']=$total_issue_bale;
                 $data['lots'][$key]['total_issue_qty']=$total_issue_qty;

                 $data['lots'][$key]['closing_bale']=$c_bale=$opening_bale_qty+$total_receive_bale-$total_issue_bale;
                 $data['lots'][$key]['closing_qty']=$c_qty=$opening_qty+$total_receive_qty-$total_issue_qty;

                 if(empty($opening_qty) && empty($p_qty) && empty($r_qty) && empty($i_qty) && empty($s_qty) && empty($c_qty) ){
                     unset($data['lots'][$key]);
                 }


            }
       }else{
          $data['lot_id']=''; 
          $data['from_date']=$from_date=date('Y-m-d');
          $data['to_date']=$to_date=date('Y-m-t');
          
          //$data['lots']=$this->m_common->get_row_array('rm_lots',array('is_active'=>1),'*');
          
          $l_sql="select iscd.*,ilc.lc_no,ilc.date,s.SUP_NAME,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_lots_details iscd
          left join rm_lots rml on iscd.lot_id=rml.id 
          left join import_lc ilc on rml.lc_id=ilc.lc_id
          left join supplier s on ilc.sup_id=s.ID
          left join rm_items rmi on iscd.item_id=rmi.id 
          left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id 
          where rml.is_active=1 group by lot_id";
          $data['lots']=$this->m_common->customeQuery($l_sql);
          
            foreach($data['lots'] as $key=>$value){
                
                 $cum_receive=array();
                 $cum_r_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd 
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where rmr.mrr_date='$cum_date' and rmrd.lot_id=".$value['id'];
                 $cum_receive=$this->m_common->customeQuery($cum_r_sql);
                 
                 $data['lots'][$key]['cum_receive_bale']=$cum_receive[0]['total_rb'];
                 $data['lots'][$key]['cum_receive_qty']=$cum_receive[0]['total_rq'];
                 
                 
                 $cum_issue=array();
                 $cum_i_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where rmi.issue_date='$cum_date' and rmid.lot_id=".$value['id'];
                 $cum_issue=$this->m_common->customeQuery($cum_i_sql);
                 
                 $data['lots'][$key]['cum_issue_bale']=$cum_issue[0]['total_ib'];
                 $data['lots'][$key]['cum_issue_qty']=$cum_issue[0]['total_iq'];
                
                
                
                 $o_receive=array();
                 $or_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id
                 where rmr.mrr_date<'$from_date' and rmrd.lot_id=".$value['id'];
                 $o_receive=$this->m_common->customeQuery($or_sql);

                 $o_issue=array();
                 $o_is_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where rmi.issue_date<'$from_date' and rmid.lot_id=".$value['id'];
                 $o_issue=$this->m_common->customeQuery($o_is_sql);

                 $opening_bale_qty=$o_receive[0]['total_rb']-$o_issue[0]['total_ib'];
                 $opening_qty=$o_receive[0]['total_rq']-$o_issue[0]['total_iq'];

                 $data['lots'][$key]['opening_bale']=$opening_bale_qty;
                 $data['lots'][$key]['opening_qty']=$opening_qty;

                 $purchase=array();
                 $p_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where rmr.mrr_date='$from_date' and rmrd.lot_id=".$value['id']." and rmr.mrr_type='Lc' ";
                 $purchase=$this->m_common->customeQuery($p_sql);

                 $data['lots'][$key]['purchase_bale']=$p_bale=$purchase[0]['total_rb'];
                 $data['lots'][$key]['purchase_qty']=$p_qty=$purchase[0]['total_rq'];

                 $return=array();
                 $r_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where rmr.mrr_date='$from_date' and rmrd.lot_id=".$value['id']." and rmr.mrr_type='Lc' ";
                 $return=$this->m_common->customeQuery($r_sql);
                 $data['lots'][$key]['return_bale']=$r_bale=$return[0]['total_rb'];
                 $data['lots'][$key]['return_qty']=$r_qty=$return[0]['total_rq'];


                 $total_receive_bale=$purchase[0]['total_rb']+$return[0]['total_rb'];
                 $total_receive_qty=$purchase[0]['total_rq']+$return[0]['total_rq'];

                 $data['lots'][$key]['total_receive_bale']=$total_receive_bale;
                 $data['lots'][$key]['total_receive_qty']=$total_receive_qty;


                 $issue=array();
                 $issue_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where rmi.issue_date='$from_date' and  rmid.lot_id=".$value['id']." and rmi.issue_type='Production Issue' ";
                 $issue=$this->m_common->customeQuery($issue_sql);
                 $data['lots'][$key]['consumption_bale']=$i_bale=$issue[0]['total_ib'];
                 $data['lots'][$key]['consumption_qty']=$i_qty=$issue[0]['total_iq'];


                 $sales=array();
                 $sale_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where rmi.issue_date='$from_date' and  rmid.lot_id=".$value['id']." and rmi.issue_type='Sales' ";
                 $sales=$this->m_common->customeQuery($sale_sql);
                 $data['lots'][$key]['sale_bale']=$s_bale=$sales[0]['total_ib'];
                 $data['lots'][$key]['sale_qty']=$s_qty=$sales[0]['total_iq'];

                 $total_issue_bale=$issue[0]['total_ib']+$sales[0]['total_ib'];
                 $total_issue_qty=$issue[0]['total_iq']+$sales[0]['total_iq'];

                 $data['lots'][$key]['total_issue_bale']=$total_issue_bale;
                 $data['lots'][$key]['total_issue_qty']=$total_issue_qty;

                 $data['lots'][$key]['closing_bale']=$c_bale=$opening_bale_qty+$total_receive_bale-$total_issue_bale;
                 $data['lots'][$key]['closing_qty']=$c_qty=$opening_qty+$total_receive_qty-$total_issue_qty;
                 
                 if(empty($opening_qty) && empty($p_qty) && empty($r_qty) && empty($i_qty) && empty($s_qty) && empty($c_qty) ){
                     unset($data['lots'][$key]);
                 }



            } 
       }
       $this->load->view('raw_materials/rm_report/v_rm_daily_transaction_report',$data);
   }
   
   
   function rawmaterialPurchaseReport(){
       
       
       
       $data['all_lots']=$this->m_common->get_row_array('rm_lots',array('is_active'=>1),'*');
       if(!empty($_POST)){
            $data['lot_id']=$lot_id=$this->input->post('lot_id');
            $data['from_date']=$from_date=date('Y-m-d',strtotime($this->input->post('from_date')));
            $data['to_date']=$to_date=date('Y-m-d',strtotime($this->input->post('to_date')));
            
            if(!empty($lot_id)){
                //$data['lots']=$this->m_common->get_row_array('rm_lots',array('is_active'=>1,'id'=>$lot_id),'*');
                $l_sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_lots_details iscd 
                left join rm_lots rml on iscd.lot_id=rml.id 
                left join rm_items rmi on iscd.item_id=rmi.id 
                left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id 
                where rml.is_active=1 and iscd.lot_id=".$lot_id." group by lot_id";
                $data['lots']=$this->m_common->customeQuery($l_sql);
            }else{
                //$data['lots']=$this->m_common->get_row_array('rm_lots',array('is_active'=>1),'*');
                $l_sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_lots_details iscd
                left join rm_lots rml on iscd.lot_id=rml.id 
                left join rm_items rmi on iscd.item_id=rmi.id 
                left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id 
                where rml.is_active=1 group by lot_id";
                $data['lots']=$this->m_common->customeQuery($l_sql);
            }
            
            foreach($data['lots'] as $key=>$value){
                 $o_receive=array();
                 $or_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd 
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where rmr.mrr_date<'$from_date' and rmrd.lot_id=".$value['id'];
                 $o_receive=$this->m_common->customeQuery($or_sql);

                 $o_issue=array();
                 $o_is_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where rmi.issue_date<'$from_date' and rmid.lot_id=".$value['id'];
                 $o_issue=$this->m_common->customeQuery($o_is_sql);

                 $opening_bale_qty=$o_receive[0]['total_rb']-$o_issue[0]['total_ib'];
                 $opening_qty=$o_receive[0]['total_rq']-$o_issue[0]['total_iq'];

                 $data['lots'][$key]['opening_bale']=$opening_bale_qty;
                 $data['lots'][$key]['opening_qty']=$opening_qty;

                 $purchase=array();
                 $p_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where (rmr.mrr_date>='$from_date' and rmr.mrr_date<='$to_date') and rmrd.lot_id=".$value['id']." and rmr.mrr_type='Lc' ";
                 $purchase=$this->m_common->customeQuery($p_sql);

                 $data['lots'][$key]['purchase_bale']=$p_bale=$purchase[0]['total_rb'];
                 $data['lots'][$key]['purchase_qty']=$p_qty=$purchase[0]['total_rq'];

                 $return=array();
                 $r_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where (rmr.mrr_date>='$from_date' and rmr.mrr_date<='$to_date') and rmrd.lot_id=".$value['id']." and rmr.mrr_type='Lc' ";
                 $return=$this->m_common->customeQuery($r_sql);
                 $data['lots'][$key]['return_bale']=$r_bale=$return[0]['total_rb'];
                 $data['lots'][$key]['return_qty']=$r_qty=$return[0]['total_rq'];


                 $total_receive_bale=$purchase[0]['total_rb']+$return[0]['total_rb'];
                 $total_receive_qty=$purchase[0]['total_rq']+$return[0]['total_rq'];

                 $data['lots'][$key]['total_receive_bale']=$total_receive_bale;
                 $data['lots'][$key]['total_receive_qty']=$total_receive_qty;


                 $issue=array();
                 $issue_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where (rmi.issue_date>='$from_date' and rmi.issue_date<='$to_date') and  rmid.lot_id=".$value['id']." and rmi.issue_type='Production Issue' ";
                 $issue=$this->m_common->customeQuery($issue_sql);
                 $data['lots'][$key]['consumption_bale']=$i_bale=$issue[0]['total_ib'];
                 $data['lots'][$key]['consumption_qty']=$i_qty=$issue[0]['total_iq'];


                 $sales=array();
                 $sale_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where (rmi.issue_date>='$from_date' and rmi.issue_date<='$to_date') and  rmid.lot_id=".$value['id']." and rmi.issue_type='Sales' ";
                 $sales=$this->m_common->customeQuery($sale_sql);
                 $data['lots'][$key]['sale_bale']=$s_bale=$sales[0]['total_ib'];
                 $data['lots'][$key]['sale_qty']=$s_qty=$sales[0]['total_iq'];

                 $total_issue_bale=$issue[0]['total_ib']+$sales[0]['total_ib'];
                 $total_issue_qty=$issue[0]['total_iq']+$sales[0]['total_iq'];

                 $data['lots'][$key]['total_issue_bale']=$total_issue_bale;
                 $data['lots'][$key]['total_issue_qty']=$total_issue_qty;

                 $data['lots'][$key]['closing_bale']=$c_bale=$opening_bale_qty+$total_receive_bale-$total_issue_bale;
                 $data['lots'][$key]['closing_qty']=$c_qty=$opening_qty+$total_receive_qty-$total_issue_qty;

                 if(empty($opening_qty) && empty($p_qty) && empty($r_qty) && empty($i_qty) && empty($s_qty) && empty($c_qty) ){
                     unset($data['lots'][$key]);
                 }


            }
       }else{
          $data['lot_id']=''; 
          $data['from_date']=$from_date=date('Y-m-01');
          $data['to_date']=$to_date=date('Y-m-t');
          
          //$data['lots']=$this->m_common->get_row_array('rm_lots',array('is_active'=>1),'*');
          
          $l_sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_lots_details iscd
          left join rm_lots rml on iscd.lot_id=rml.id 
          left join rm_items rmi on iscd.item_id=rmi.id 
          left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id 
          where rml.is_active=1 group by lot_id";
          $data['lots']=$this->m_common->customeQuery($l_sql);
          
            foreach($data['lots'] as $key=>$value){
                 $o_receive=array();
                 $or_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id
                 where rmr.mrr_date<'$from_date' and rmrd.lot_id=".$value['id'];
                 $o_receive=$this->m_common->customeQuery($or_sql);

                 $o_issue=array();
                 $o_is_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where rmi.issue_date<'$from_date' and rmid.lot_id=".$value['id'];
                 $o_issue=$this->m_common->customeQuery($o_is_sql);

                 $opening_bale_qty=$o_receive[0]['total_rb']-$o_issue[0]['total_ib'];
                 $opening_qty=$o_receive[0]['total_rq']-$o_issue[0]['total_iq'];

                 $data['lots'][$key]['opening_bale']=$opening_bale_qty;
                 $data['lots'][$key]['opening_qty']=$opening_qty;

                 $purchase=array();
                 $p_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where (rmr.mrr_date>='$from_date' and rmr.mrr_date<='$to_date') and rmrd.lot_id=".$value['id']." and rmr.mrr_type='Lc' ";
                 $purchase=$this->m_common->customeQuery($p_sql);

                 $data['lots'][$key]['purchase_bale']=$p_bale=$purchase[0]['total_rb'];
                 $data['lots'][$key]['purchase_qty']=$p_qty=$purchase[0]['total_rq'];

                 $return=array();
                 $r_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where (rmr.mrr_date>='$from_date' and rmr.mrr_date<='$to_date') and rmrd.lot_id=".$value['id']." and rmr.mrr_type='Lc' ";
                 $return=$this->m_common->customeQuery($r_sql);
                 $data['lots'][$key]['return_bale']=$r_bale=$return[0]['total_rb'];
                 $data['lots'][$key]['return_qty']=$r_qty=$return[0]['total_rq'];


                 $total_receive_bale=$purchase[0]['total_rb']+$return[0]['total_rb'];
                 $total_receive_qty=$purchase[0]['total_rq']+$return[0]['total_rq'];

                 $data['lots'][$key]['total_receive_bale']=$total_receive_bale;
                 $data['lots'][$key]['total_receive_qty']=$total_receive_qty;


                 $issue=array();
                 $issue_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where (rmi.issue_date>='$from_date' and rmi.issue_date<='$to_date') and  rmid.lot_id=".$value['id']." and rmi.issue_type='Production Issue' ";
                 $issue=$this->m_common->customeQuery($issue_sql);
                 $data['lots'][$key]['consumption_bale']=$i_bale=$issue[0]['total_ib'];
                 $data['lots'][$key]['consumption_qty']=$i_qty=$issue[0]['total_iq'];


                 $sales=array();
                 $sale_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where (rmi.issue_date>='$from_date' and rmi.issue_date<='$to_date') and  rmid.lot_id=".$value['id']." and rmi.issue_type='Sales' ";
                 $sales=$this->m_common->customeQuery($sale_sql);
                 $data['lots'][$key]['sale_bale']=$s_bale=$sales[0]['total_ib'];
                 $data['lots'][$key]['sale_qty']=$s_qty=$sales[0]['total_iq'];

                 $total_issue_bale=$issue[0]['total_ib']+$sales[0]['total_ib'];
                 $total_issue_qty=$issue[0]['total_iq']+$sales[0]['total_iq'];

                 $data['lots'][$key]['total_issue_bale']=$total_issue_bale;
                 $data['lots'][$key]['total_issue_qty']=$total_issue_qty;

                 $data['lots'][$key]['closing_bale']=$c_bale=$opening_bale_qty+$total_receive_bale-$total_issue_bale;
                 $data['lots'][$key]['closing_qty']=$c_qty=$opening_qty+$total_receive_qty-$total_issue_qty;
                 
                 if(empty($opening_qty) && empty($p_qty) && empty($r_qty) && empty($i_qty) && empty($s_qty) && empty($c_qty) ){
                     unset($data['lots'][$key]);
                 }



            } 
       }
       $this->load->view('raw_materials/rm_report/v_rm_purchase_report',$data);
   }
   
   
   
   function rawmaterialIssueReport(){
       
       
       
       $data['all_lots']=$this->m_common->get_row_array('rm_lots',array('is_active'=>1),'*');
       if(!empty($_POST)){
            $data['lot_id']=$lot_id=$this->input->post('lot_id');
            $data['from_date']=$from_date=date('Y-m-d',strtotime($this->input->post('from_date')));
            $data['to_date']=$to_date=date('Y-m-d',strtotime($this->input->post('to_date')));
            
            if(!empty($lot_id)){
                //$data['lots']=$this->m_common->get_row_array('rm_lots',array('is_active'=>1,'id'=>$lot_id),'*');
                $l_sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_lots_details iscd 
                left join rm_lots rml on iscd.lot_id=rml.id 
                left join rm_items rmi on iscd.item_id=rmi.id 
                left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id 
                where rml.is_active=1 and iscd.lot_id=".$lot_id." group by lot_id";
                $data['lots']=$this->m_common->customeQuery($l_sql);
            }else{
                //$data['lots']=$this->m_common->get_row_array('rm_lots',array('is_active'=>1),'*');
                $l_sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_lots_details iscd
                left join rm_lots rml on iscd.lot_id=rml.id 
                left join rm_items rmi on iscd.item_id=rmi.id 
                left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id 
                where rml.is_active=1 group by lot_id";
                $data['lots']=$this->m_common->customeQuery($l_sql);
            }
            
            foreach($data['lots'] as $key=>$value){
                 $o_receive=array();
                 $or_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd 
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where rmr.mrr_date<'$from_date' and rmrd.lot_id=".$value['id'];
                 $o_receive=$this->m_common->customeQuery($or_sql);

                 $o_issue=array();
                 $o_is_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where rmi.issue_date<'$from_date' and rmid.lot_id=".$value['id'];
                 $o_issue=$this->m_common->customeQuery($o_is_sql);

                 $opening_bale_qty=$o_receive[0]['total_rb']-$o_issue[0]['total_ib'];
                 $opening_qty=$o_receive[0]['total_rq']-$o_issue[0]['total_iq'];

                 $data['lots'][$key]['opening_bale']=$opening_bale_qty;
                 $data['lots'][$key]['opening_qty']=$opening_qty;

                 $purchase=array();
                 $p_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where (rmr.mrr_date>='$from_date' and rmr.mrr_date<='$to_date') and rmrd.lot_id=".$value['id']." and rmr.mrr_type='Lc' ";
                 $purchase=$this->m_common->customeQuery($p_sql);

                 $data['lots'][$key]['purchase_bale']=$p_bale=$purchase[0]['total_rb'];
                 $data['lots'][$key]['purchase_qty']=$p_qty=$purchase[0]['total_rq'];

                 $return=array();
                 $r_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where (rmr.mrr_date>='$from_date' and rmr.mrr_date<='$to_date') and rmrd.lot_id=".$value['id']." and rmr.mrr_type='Lc' ";
                 $return=$this->m_common->customeQuery($r_sql);
                 $data['lots'][$key]['return_bale']=$r_bale=$return[0]['total_rb'];
                 $data['lots'][$key]['return_qty']=$r_qty=$return[0]['total_rq'];


                 $total_receive_bale=$purchase[0]['total_rb']+$return[0]['total_rb'];
                 $total_receive_qty=$purchase[0]['total_rq']+$return[0]['total_rq'];

                 $data['lots'][$key]['total_receive_bale']=$total_receive_bale;
                 $data['lots'][$key]['total_receive_qty']=$total_receive_qty;


                 $issue=array();
                 $issue_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where (rmi.issue_date>='$from_date' and rmi.issue_date<='$to_date') and  rmid.lot_id=".$value['id']." and rmi.issue_type='Production Issue' ";
                 $issue=$this->m_common->customeQuery($issue_sql);
                 $data['lots'][$key]['consumption_bale']=$i_bale=$issue[0]['total_ib'];
                 $data['lots'][$key]['consumption_qty']=$i_qty=$issue[0]['total_iq'];


                 $sales=array();
                 $sale_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where (rmi.issue_date>='$from_date' and rmi.issue_date<='$to_date') and  rmid.lot_id=".$value['id']." and rmi.issue_type='Sales' ";
                 $sales=$this->m_common->customeQuery($sale_sql);
                 $data['lots'][$key]['sale_bale']=$s_bale=$sales[0]['total_ib'];
                 $data['lots'][$key]['sale_qty']=$s_qty=$sales[0]['total_iq'];

                 $total_issue_bale=$issue[0]['total_ib']+$sales[0]['total_ib'];
                 $total_issue_qty=$issue[0]['total_iq']+$sales[0]['total_iq'];

                 $data['lots'][$key]['total_issue_bale']=$total_issue_bale;
                 $data['lots'][$key]['total_issue_qty']=$total_issue_qty;

                 $data['lots'][$key]['closing_bale']=$c_bale=$opening_bale_qty+$total_receive_bale-$total_issue_bale;
                 $data['lots'][$key]['closing_qty']=$c_qty=$opening_qty+$total_receive_qty-$total_issue_qty;

                 if(empty($opening_qty) && empty($p_qty) && empty($r_qty) && empty($i_qty) && empty($s_qty) && empty($c_qty) ){
                     unset($data['lots'][$key]);
                 }


            }
       }else{
          $data['lot_id']=''; 
          $data['from_date']=$from_date=date('Y-m-01');
          $data['to_date']=$to_date=date('Y-m-t');
          
          //$data['lots']=$this->m_common->get_row_array('rm_lots',array('is_active'=>1),'*');
          
          $l_sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,tmu.meas_unit from rm_lots_details iscd
          left join rm_lots rml on iscd.lot_id=rml.id 
          left join rm_items rmi on iscd.item_id=rmi.id 
          left join tbl_measurement_unit tmu on rmi.mu_id=tmu.id 
          where rml.is_active=1 group by lot_id";
          $data['lots']=$this->m_common->customeQuery($l_sql);
          
            foreach($data['lots'] as $key=>$value){
                 $o_receive=array();
                 $or_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id
                 where rmr.mrr_date<'$from_date' and rmrd.lot_id=".$value['id'];
                 $o_receive=$this->m_common->customeQuery($or_sql);

                 $o_issue=array();
                 $o_is_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where rmi.issue_date<'$from_date' and rmid.lot_id=".$value['id'];
                 $o_issue=$this->m_common->customeQuery($o_is_sql);

                 $opening_bale_qty=$o_receive[0]['total_rb']-$o_issue[0]['total_ib'];
                 $opening_qty=$o_receive[0]['total_rq']-$o_issue[0]['total_iq'];

                 $data['lots'][$key]['opening_bale']=$opening_bale_qty;
                 $data['lots'][$key]['opening_qty']=$opening_qty;

                 $purchase=array();
                 $p_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where (rmr.mrr_date>='$from_date' and rmr.mrr_date<='$to_date') and rmrd.lot_id=".$value['id']." and rmr.mrr_type='Lc' ";
                 $purchase=$this->m_common->customeQuery($p_sql);

                 $data['lots'][$key]['purchase_bale']=$p_bale=$purchase[0]['total_rb'];
                 $data['lots'][$key]['purchase_qty']=$p_qty=$purchase[0]['total_rq'];

                 $return=array();
                 $r_sql="select sum(rmrd.receive_qty) as total_rq,sum(rmrd.accepted_bale_qty) as total_rb from rm_receive_details rmrd
                 left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id 
                 where (rmr.mrr_date>='$from_date' and rmr.mrr_date<='$to_date') and rmrd.lot_id=".$value['id']." and rmr.mrr_type='Lc' ";
                 $return=$this->m_common->customeQuery($r_sql);
                 $data['lots'][$key]['return_bale']=$r_bale=$return[0]['total_rb'];
                 $data['lots'][$key]['return_qty']=$r_qty=$return[0]['total_rq'];


                 $total_receive_bale=$purchase[0]['total_rb']+$return[0]['total_rb'];
                 $total_receive_qty=$purchase[0]['total_rq']+$return[0]['total_rq'];

                 $data['lots'][$key]['total_receive_bale']=$total_receive_bale;
                 $data['lots'][$key]['total_receive_qty']=$total_receive_qty;


                 $issue=array();
                 $issue_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where (rmi.issue_date>='$from_date' and rmi.issue_date<='$to_date') and  rmid.lot_id=".$value['id']." and rmi.issue_type='Production Issue' ";
                 $issue=$this->m_common->customeQuery($issue_sql);
                 $data['lots'][$key]['consumption_bale']=$i_bale=$issue[0]['total_ib'];
                 $data['lots'][$key]['consumption_qty']=$i_qty=$issue[0]['total_iq'];


                 $sales=array();
                 $sale_sql="select sum(rmid.issue_qty) as total_iq,sum(rmid.bale_qty) as total_ib  from rm_issue_details rmid
                 left join rm_issue rmi on rmid.issue_id=rmi.id 
                 where (rmi.issue_date>='$from_date' and rmi.issue_date<='$to_date') and  rmid.lot_id=".$value['id']." and rmi.issue_type='Sales' ";
                 $sales=$this->m_common->customeQuery($sale_sql);
                 $data['lots'][$key]['sale_bale']=$s_bale=$sales[0]['total_ib'];
                 $data['lots'][$key]['sale_qty']=$s_qty=$sales[0]['total_iq'];

                 $total_issue_bale=$issue[0]['total_ib']+$sales[0]['total_ib'];
                 $total_issue_qty=$issue[0]['total_iq']+$sales[0]['total_iq'];

                 $data['lots'][$key]['total_issue_bale']=$total_issue_bale;
                 $data['lots'][$key]['total_issue_qty']=$total_issue_qty;

                 $data['lots'][$key]['closing_bale']=$c_bale=$opening_bale_qty+$total_receive_bale-$total_issue_bale;
                 $data['lots'][$key]['closing_qty']=$c_qty=$opening_qty+$total_receive_qty-$total_issue_qty;
                 
                 if(empty($opening_qty) && empty($p_qty) && empty($r_qty) && empty($i_qty) && empty($s_qty) && empty($c_qty) ){
                     unset($data['lots'][$key]);
                 }



            } 
       }
       $this->load->view('raw_materials/rm_report/v_rm_issue_report',$data);
   }
   
   
   function rawmaterialInHand(){
       $this->load->view('raw_materials/rm_report/v_rm_in_hand');
   }
   
   function rawmaterialInPipeLine(){
       $this->load->view('raw_materials/rm_report/v_rm_in_pipeline');
   }
   
   
     function lotInfo(){
        $this->setOutputMode(NORMAL);
        $lot_id=$this->input->post('lot_id');
        $sql="select l.*,sc.count_name,sp.process_name from tbl_fg_lots l left join tbl_sales_products tsp on l.fg_id=tsp.product_id left join sales_count sc on tsp.count_id=sc.id left join sales_process sp on tsp.process_id=sp.id where l.id=$lot_id";
        $data['lot_info']=$this->m_common->customeQuery($sql);
        
        echo json_encode($data);
     }
    
     
     function bagInfo(){
        $this->setOutputMode(NORMAL);
        $bag_id=$this->input->post('bag_id');
        $bag_qty=$this->input->post('bag_qty');
        $bag_info=$this->m_common->get_row_array('tbl_package',array('id'=>$bag_id),'*');
        if(!empty($bag_info[0]['qty_per_pack'])){
            $total_qty=$bag_info[0]['qty_per_pack']*$bag_qty;
            $total_qty_lbs=round(2.20*$total_qty,2);
        }else{
            $total_qty='';
            $total_qty_lbs='';
        }
        
        $data['total_qty']=$total_qty;
        $data['total_qty_lbs']=$total_qty_lbs;
        
        echo json_encode($data);
     }
}

