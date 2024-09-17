<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rm_qc extends Site_Controller {

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
        $this->menu = 'general_store';    
        $this->sub_inner_menu = 'rm_qc';
        $this->titlebackend("Material Receive Register");
    
        $sql="select * from rm_receive where mrr_type='Lc' and unit_id=".$branch_id." ORDER BY mrr_id DESC ";
        $data['mrrs'] = $this->m_common->customeQuery($sql);
        $this->load->view('raw_materials/rm_qc/v_rm_qc',$data);
    }
    
    // Start Material Receive Requisition(MRR)  
    
    
    
    
    
    function add_rm_qc() {
        $this->menu = 'general_store';
    //    $this->sub_menu = 'rm_qc';
        $this->sub_inner_menu = 'rm_qc';
        $user_type = $this->session->userdata('user_type');
        $this->titlebackend("Add Material Receive Requisition");
        $branch_id= $this->session->userdata('companyId');
        
        $data['branch_info']=$this->m_common->get_row_array('department',array('d_id' =>$branch_id),'*');
        $sql = "select sl.*,c.SUP_NAME as buyer_name,b.b_name as buyer_bank,b1.b_name as our_bank from import_lc sl  left join supplier as c on c.ID=sl.sup_id join tbl_banks b on b.id=sl.party_bank join tbl_banks b1 on b1.id=sl.our_bank where sl.branch_id=$branch_id order by lc_id DESC";
        $data['lcs'] = $this->m_common->customeQuery($sql);
     
       $mrr_last_code=$this->m_common->get_row_array('rm_qc_code',array('branch_id'=>$branch_id),'*','',1,'id','DESC');
       if(!empty($mrr_last_code)){
           
            $mrr_code=$mrr_last_code[0]['mrr_code']+1;
            if($mrr_code>999){
                $mrr_sl_no=$mrr_code;
            }else if($dep_code>99){
                $mrr_sl_no="0".$mrr_code;
            }else if($mrr_code>9){
                $mrr_sl_no="00".$mrr_code;
            }else{
                $mrr_sl_no="000".$mrr_code;
            }
        }else{
            $mrr_code=1;
            $mrr_sl_no='0001';
        }
        
        $data['mrr_code']=$mrr_code;
        $data['mrr_auto_code']=$mrr_sl_no;
        
        $this->load->view('raw_materials/rm_qc/v_add_rm_qc',$data);
    }
    
    function add_action_rm_qc(){
        $this->menu = 'general_store';
        $this->sub_menu = 'rm_qc';
        $this->titlebackend("Add Material Receive Requisition");
        $branch_id= $this->session->userdata('companyId');
        $postData = $this->input->post();
        $mrr_code=$this->input->post('mrr_code');
        if (!empty($postData)) {
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
            
           if(!empty($postData['lc_id'])){
                $insertData['lc_id'] = $postData['lc_id']; 
                $purchase_id=$postData['lc_id']; 
            }
            
            $branch_info=$this->m_common->get_row_array('import_lc',array('lc_id'=>$postData['lc_id']),'*');
            
            if(!empty($postData['mrr_no'])){
                $insertData['mrr_no'] = $postData['mrr_no']; 
            }
            
            
            if(!empty($postData['qc_no'])){
                $insertData['qc_no'] = $postData['qc_no']; 
            }
            
            if(!empty($postData['mrr_date'])){
                $insertData['mrr_date'] =date('Y-m-d',strtotime($postData['mrr_date'])); 
                $receive_date=date('Y-m-d',strtotime($postData['mrr_date'])); 
            }
          
            if(!empty($postData['mrr_challan'])){
                $insertData['mrr_challan'] = $postData['mrr_challan']; 
            }
           
            if(!empty($postData['mrr_challan_date'])){
                $insertData['mrr_challan_date'] =date('Y-m-d',strtotime($postData['mrr_challan_date'])); 
            }
           
            if(!empty($postData['mrr_remark'])){
                $insertData['mrr_remark'] = $postData['mrr_remark']; 
            }
            
           // $insertData['unit_id'] =$branch_id;
            $insertData['unit_id'] =$branch_info[0]['branch_id'];
            if(empty($postData['item_select'])){
                 redirect_with_msg('raw_materials/rm_qc/add_rm_qc', 'Please Select Item');
            }
            
            $id = $this->m_common->insert_row('rm_receive', $insertData);
            if (!empty($id)) {
               //  $this->m_common->insert_row('material_receive_code', array('mrr_code'=>$mrr_code));
                $this->m_common->insert_row('material_receive_code', array('mrr_code'=>$mrr_code,'branch_id'=>$branch_id));
                 foreach ($postData['item_id'] as $key => $each) {
                      if(in_array($key,$postData['item_select'])){
                                $insertData1=array();
                                $insertData1['item_id'] = $each;
                                $insertData1['mrr_id'] = $id;
                                $insertData1['receive_date'] = $receive_date;
                                $insertData1['bill_status'] ='Pending';
                                $insertData1['payment_status'] ='Pending';
                                
                                
                                $insertData1['package_id']=3;
                                
                                if(!empty($postData['lot_d_id'][$key])) {
                                    $insertData1['lot_d_id'] =$postData['lot_d_id'][$key];
                                }
                               
                                
                                $insertData1['inv_bale_qty'] = $postData['inv_bale_qty'][$key];
                    
                                $insertData1['inv_weight'] = $postData['inv_weight'][$key];
                                $insertData1['landed_weight'] = $postData['landed_weight'][$key];
                                $insertData1['accepted_bale_qty'] = $postData['accepted_bale_qty'][$key];
                                
                                if(!empty($postData['accepted_weight'][$key])){
                                    $insertData1['initial_receive_qty'] = $postData['accepted_weight'][$key];
                                }
                               
                                if(!empty($postData['accepted_weight'][$key])){
                                    $insertData1['receive_qty'] = $postData['accepted_weight'][$key];
                                }
                                
                                if(!empty($postData['challan_qty'][$key])){
                                    $insertData1['challan_qty'] = $postData['challan_qty'][$key];
                                }
                                
                               
                                
                                if(!empty($postData['unit_price'][$key])){
                                    $insertData1['unit_price'] = $postData['unit_price'][$key];
                                }
                               
                                if (!empty($postData['amount'][$key])){
                                    $insertData1['amount'] = $postData['amount'][$key];
                                }
                                if(!empty($postData['remark'][$key])){
                                    $insertData1['remark'] = $postData['remark'][$key];
                                }
                                $this->m_common->insert_row('rm_receive_details', $insertData1); 
                             
                      }
                   
                 }
                redirect_with_msg('raw_materials/rm_qc', 'Successfully  Added Material Receive Requistion');
            } else {
                redirect_with_msg('raw_materials/rm_qc/add_rm_qc', 'Data not saved for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/rm_qc/add_rm_qc', 'Please fill the form and submit');
        }
        
    }
    
function edit_rm_qc($id) {
    $this->menu = 'general_store';
    $this->sub_inner_menu = 'rm_qc';
    $user_type = $this->session->userdata('user_type');
    $branch_id= $this->session->userdata('companyId');

    $this->titlebackend("Edit Material Receive Requisition");
    $data['suppliers'] = $this->m_common->get_row_array('supplier', '', '*');
    $r_sql="select rmr.*,ilc.date from rm_receive rmr left join import_lc ilc on rmr.lc_id=ilc.lc_id where rmr.mrr_id=".$id;
    $data['mrr'] = $this->m_common->customeQuery($r_sql);

    $sql = "select sl.*,c.SUP_NAME as buyer_name,b.b_name as buyer_bank,b1.b_name as our_bank from import_lc sl  left join supplier as c on c.ID=sl.sup_id join tbl_banks b on b.id=sl.party_bank join tbl_banks b1 on b1.id=sl.our_bank where sl.branch_id=$branch_id order by lc_id DESC";
    $data['lcs'] = $this->m_common->customeQuery($sql);

    
    $sql="select rmrd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,rl.lot_number from rm_receive_details rmrd left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id left join rm_items rmi on rmrd.item_id=rmi.id left join rm_lots_details rld on rmrd.lot_d_id=rld.id left join rm_lots rl on rld.lot_id=rl.id where rmrd.mrr_id=".$id;
    $data['receive_items']=$this->m_common->customeQuery($sql);

    $this->load->view('raw_materials/rm_qc/v_edit_rm_qc',$data);
}
    
    
function details_rm_qc($id,$print=false) {
        $this->menu = 'general_store';
        $this->sub_inner_menu = 'rm_qc';
        $user_type = $this->session->userdata('user_type');
        $branch_id= $this->session->userdata('companyId');
       
        
        $this->titlebackend("Details Material Receive Requisition");
        $r_sql="select rmr.*,ilc.date from rm_receive rmr left join import_lc ilc on rmr.lc_id=ilc.lc_id where rmr.mrr_id=".$id;
        $data['mrr'] = $this->m_common->customeQuery($r_sql);
        
        $sql = "select sl.*,c.SUP_NAME as buyer_name,b.b_name as buyer_bank,b1.b_name as our_bank from import_lc sl  left join supplier as c on c.ID=sl.sup_id join tbl_banks b on b.id=sl.party_bank join tbl_banks b1 on b1.id=sl.our_bank where sl.branch_id=$branch_id order by lc_id DESC";
        $data['lcs']=$this->m_common->customeQuery($sql);


        $sql="select rmrd.*,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length,rl.lot_number from rm_receive_details rmrd left join rm_receive rmr on rmrd.mrr_id=rmr.mrr_id left join rm_items rmi on rmrd.item_id=rmi.id left join rm_lots_details rld on rmrd.lot_d_id=rld.id left join rm_lots rl on rld.lot_id=rl.id where rmrd.mrr_id=".$id;
        $data['receive_items']=$this->m_common->customeQuery($sql);
        
        if($print==false){
            $this->load->view('raw_materials/rm_qc/v_details_rm_qc',$data);
        }else{
            $html=$this->load->view('raw_materials/rm_qc/print_mrr',$data,true);
            echo $html;
            exit; 
        }
    }
    
function confirmReceive($id){
        $branch_id= $this->session->userdata('companyId');        
        $material_receive_info=$this->m_common->get_row_array('rm_qc',array('mrr_id'=>$id),'*');
        $receive_items=$this->m_common->get_row_array('rm_qc_details',array('mrr_id'=>$id),'*');
        //$result=$this->m_common->update_row('tbl_delivery_challans',array('dc_id'=>$id),array('status'=>"Approved"));
        $result=$this->m_common->update_row('rm_qc',array('mrr_id'=>$id),array('mrr_status'=>"received"));
        if(!empty($result)){
            foreach($receive_items as $item){
                $com_item_info=array();
                $indent_item_info=array();
                $com_item_info=$this->m_common->get_row_array('items',array('id'=>$item['item_id']),'stock_amount');
                $indent_item_info=$this->m_common->get_row_array('ipo_material_indent_details',array('id'=>$item['indent_d_id'],'item_id'=>$item['item_id']),'*');
                $com_current_stock=$com_item_info[0]['stock_amount']+$item['receive_qty'];
                $this->m_common->update_row('items',array('id'=>$item['item_id']),array('stock_amount'=>$com_current_stock));
                
                $net_r_qty=$indent_item_info[0]['receive_qty']+$item['receive_qty'];
                if($net_r_qty==$indent_item_info[0]['indent_qty']){
                    $in_r_status="Received";
                }else{
                    $in_r_status="Partially Received";
                }
                
                
                $this->m_common->update_row('ipo_material_indent_details',array('id'=>$item['indent_d_id']),array('receive_qty'=>$net_r_qty,'receive_status'=>$in_r_status));               
               // $branch_item_info=$this->m_common->get_row_array('tbl_item_stock',array('item_id'=>$item['item_id'],'unit_id'=>$branch_id),'quantity');
                $branch_item_info=$this->m_common->get_row_array('tbl_item_stock',array('item_id'=>$item['item_id'],'unit_id'=>$material_receive_info[0]['unit_id']),'quantity');
                if(!empty($branch_item_info)){
                    $b_current_stock=$branch_item_info[0]['quantity']+$item['receive_qty'];
                    //$this->m_common->update_row('tbl_item_stock',array('item_id'=>$item['item_id'],'unit_id'=>$branch_id),array('quantity'=>$b_current_stock));
                    $this->m_common->update_row('tbl_item_stock',array('item_id'=>$item['item_id'],'unit_id'=>$material_receive_info[0]['unit_id']),array('quantity'=>$b_current_stock));
                }else{
                    $b_current_stock=$item['receive_qty'];
                   // $this->m_common->insert_row('tbl_item_stock',array('item_id'=>$item['item_id'],'unit_id'=>$branch_id,'quantity'=>$b_current_stock));
                    $this->m_common->insert_row('tbl_item_stock',array('item_id'=>$item['item_id'],'unit_id'=>$material_receive_info[0]['unit_id'],'quantity'=>$b_current_stock));
                }
                
                $purchase_order_item=array();
            //    $purchase_order_item=$this->m_common->get_row_array('tbl_purchase_order_details',array('o_id'=>$material_receive_info[0]['po_id'],'item_id'=>$item['item_id']),'*'); //30-12-2020
                $purchase_order_item=$this->m_common->get_row_array('tbl_purchase_order_details',array('o_details_id'=>$item['o_details_id']),'*');
                $receive_quanity=$purchase_order_item[0]['receive_quantity']+$item['receive_qty'];
                if($receive_quanity==$purchase_order_item[0]['quantity']){
                    $status="Received";
                }else{
                     $status="Partially Received";
                }
               // $this->m_common->update_row('tbl_purchase_order_details',array('o_id'=>$material_receive_info[0]['po_id'],'item_id'=>$item['item_id']),array('receive_quantity'=>$receive_quanity,'receive_status'=>$status));//30-12-2020
               $this->m_common->update_row('tbl_purchase_order_details',array('o_details_id'=>$item['o_details_id']),array('receive_quantity'=>$receive_quanity,'receive_status'=>$status));
            }
        }
        $purchase_order_items=$this->m_common->get_row_array('tbl_purchase_order_details',array('o_id'=>$material_receive_info[0]['po_id']),'*');
        $j=0;
        foreach($purchase_order_items as $p_item){
             if($p_item['receive_status']!="Received"){
                 $j=1;
             }
        }
       
        if($j==1){
            $this->m_common->update_row('tbl_purchase_orders',array('o_id'=>$material_receive_info[0]['po_id']),array('status'=>"Partially Received"));
        }else{
            $this->m_common->update_row('tbl_purchase_orders',array('o_id'=>$material_receive_info[0]['po_id']),array('status'=>"Received"));
        }
       redirect_with_msg('raw_materials/rm_qc/rm_qc', 'Successfully Received Items');
    }
    


function edit_action_rm_qc($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'rm_qc';
        $this->titlebackend("Edit Material Receive Requisition");
        $branch_id= $this->session->userdata('companyId');
        $postData = $this->input->post();
        if(!empty($postData)){
            $insertData = array();
            $insertData['created'] = date('Y-m-d');
            if(!empty($postData['lc_id'])){
                $insertData['lc_id'] = $postData['lc_id']; 
                
            }
            
            
            if(!empty($postData['mrr_no'])){
                $insertData['mrr_no'] = $postData['mrr_no']; 
            }
            
            if(!empty($postData['mrr_date'])){
                $insertData['mrr_date'] =date('Y-m-d',strtotime($postData['mrr_date'])); 
                $receive_date=date('Y-m-d',strtotime($postData['mrr_date'])); 
            }
          
           if(!empty($postData['mrr_challan'])){
                $insertData['mrr_challan'] = $postData['mrr_challan']; 
           }
           
            if(!empty($postData['mrr_challan_date'])){
                $insertData['mrr_challan_date'] =date('Y-m-d',strtotime($postData['mrr_challan_date'])); 
            }
           
            if(!empty($postData['mrr_remark'])){
                $insertData['mrr_remark'] = $postData['mrr_remark']; 
            }
            
           // $insertData['unit_id'] =$branch_info[0]['unit_id'];
            $s_id=$this->m_common->update_row('rm_receive',array('mrr_id'=>$id),$insertData);
            $delete_details=$this->m_common->delete_row('rm_receive_details',array('mrr_id'=>$id));
            if (!empty($s_id)) {
                  foreach ($postData['item_id'] as $key => $each) {
                    $insertData1=array();
                    $insertData1['item_id'] = $each;
                    $insertData1['mrr_id'] = $id;
                    $insertData1['receive_date'] = $receive_date;

                    $insertData1['package_id']=3;


                     if(!empty($postData['lot_id'][$key])) {
                         $insertData1['lot_id'] =$postData['lot_id'][$key];
                     }

                     if(!empty($postData['lot_d_id'][$key])) {
                         $insertData1['lot_d_id'] =$postData['lot_d_id'][$key];
                     }


                     $insertData1['inv_bale_qty'] = $postData['inv_bale_qty'][$key];

                     $insertData1['inv_weight'] = $postData['inv_weight'][$key];
                     $insertData1['landed_weight'] = $postData['landed_weight'][$key];
                     $insertData1['accepted_bale_qty'] = $postData['accepted_bale_qty'][$key];

                     if(!empty($postData['accepted_weight'][$key])){
                         $insertData1['initial_receive_qty'] = $postData['accepted_weight'][$key];
                     }

                     if(!empty($postData['accepted_weight'][$key])){
                         $insertData1['receive_qty'] = $postData['accepted_weight'][$key];
                     }


                     if (!empty($postData['unit_price'][$key])) {
                         $insertData1['unit_price'] = $postData['unit_price'][$key];
                     }

                     if (!empty($postData['amount'][$key])) {
                         $insertData1['amount'] = $postData['amount'][$key];
                     }
                     if (!empty($postData['remark'][$key])) {
                         $insertData1['remark'] = $postData['remark'][$key];
                     }
                      
                    $this->m_common->insert_row('rm_receive_details', $insertData1);
                   
                 }
                
                    redirect_with_msg('raw_materials/rm_qc/details_rm_qc/'.$id, 'Successfully Updated Material Receive Requisition');
              
            }else{
                  foreach ($postData['item_id'] as $key => $each) {
                    $insertData1=array();
                    $insertData1['item_id'] = $each;
                    $insertData1['mrr_id'] = $id;
                    $insertData1['receive_date'] = $receive_date;
                    $insertData1['package_id']=3;
                    
                    
                    if(!empty($postData['lot_id'][$key])) {
                        $insertData1['lot_id'] =$postData['lot_id'][$key];
                    }
                    
                    
                    if(!empty($postData['lot_d_id'][$key])) {
                        $insertData1['lot_d_id'] =$postData['lot_d_id'][$key];
                    }


                    $insertData1['inv_bale_qty'] = $postData['inv_bale_qty'][$key];

                    $insertData1['inv_weight'] = $postData['inv_weight'][$key];
                    $insertData1['landed_weight'] = $postData['landed_weight'][$key];
                    $insertData1['accepted_bale_qty'] = $postData['accepted_bale_qty'][$key];

                    if(!empty($postData['accepted_weight'][$key])){
                        $insertData1['initial_receive_qty'] = $postData['accepted_weight'][$key];
                    }

                    if(!empty($postData['accepted_weight'][$key])){
                        $insertData1['receive_qty'] = $postData['accepted_weight'][$key];
                    }

                    if (!empty($postData['unit_price'][$key])) {
                        $insertData1['unit_price'] = $postData['unit_price'][$key];
                    }

                    if (!empty($postData['amount'][$key])) {
                        $insertData1['amount'] = $postData['amount'][$key];
                    }
                    if (!empty($postData['remark'][$key])) {
                        $insertData1['remark'] = $postData['remark'][$key];
                    }
                      
                    $this->m_common->insert_row('rm_receive_details', $insertData1);
                  
                 }
                 redirect_with_msg('raw_materials/rm_qc/details_rm_qc/'.$id, 'Successfully Updated Material Receive Requisition Info');
            }
        } else {
            redirect_with_msg('raw_materials/rm_qc/edit_rm_qc/'.$id, 'Please fill the form and submit');
        }
    }
    
    function delete_rm_qc($id) {
         $this->menu = 'general_store';
        $this->sub_menu = 'rm_qc';
        $this->titlebackend("Material Receive Requisition");
         if (!empty($id)) {  
            $ids = $this->m_common->delete_row('rm_receive', array('mrr_id' => $id));
            if(!empty($ids)){             
                $this->m_common->delete_row('rm_receive_details', array('mrr_id' => $id));              
                redirect_with_msg('raw_materials/rm_qc', 'Successfully Deleted');
            } else {
                redirect_with_msg('raw_materials/rm_qc', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('raw_materials/rm_qc', 'Please click on delete button');
        }
    }
    
//End Material Receive Requisition(MRR)  
    
    
    function approveQc($id){
        $branch_id= $this->session->userdata('companyId');        
        
        $result=$this->m_common->update_row('rm_receive',array('mrr_id'=>$id),array('qc_status'=>"Approved"));
        if(!empty($result)){
           redirect_with_msg('raw_materials/rm_qc', 'Successfully Approved');
        }else{
           redirect_with_msg('raw_materials/rm_qc', 'Not Approved');  
        }
      
       
    }
    
    
    function getLcLotDetails(){
        $this->setOutputMode(NORMAL);
        $lc_id=$this->input->post('lc_id');
        $data['lot_info']=$this->m_common->get_row_array('import_lc',array('lc_id'=>$lc_id),'*');
        if(!empty($data['lot_info'])){
            $data['lot_info'][0]['date']=date('d-m-Y',strtotime($data['lot_info'][0]['date']));
        }
        $sql="select iscd.*,rml.lot_number,rmi.item_code,rmi.item_name,rmi.origin,rmi.staple_length from rm_lots_details iscd left join rm_lots rml on iscd.lot_id=rml.id left join rm_items rmi on iscd.item_id=rmi.id where rml.is_active=1 and rml.lc_id=".$lc_id;
        $data['lc_details']=$this->m_common->customeQuery($sql);
        echo json_encode($data);
        
    } 
    
    
    
}

