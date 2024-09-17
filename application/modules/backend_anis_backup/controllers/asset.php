<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Asset extends Site_Controller {

    function __construct() {
        parent::__construct();
        if (!$this->is_logged_in($this->session->userdata('logged_in'))) {
            redirect_with_msg('backend/login', 'Please Login to see this page');
        }
        $this->load->model("m_common");
        $this->setTemplateFile('template');
        $this->user_id = $this->session->userdata('user_id');
    }

    function index() {
        $this->menu = 'general_store';
        $this->sub_menu = 'asset';
        $this->sub_inner_menu = 'asset_list';
        $this->titlebackend("Assets");
        $data['assets'] = $this->m_common->get_row_array('assets', '', '*');
        $this->load->view('asset/v_asset', $data);
    }

    function add_asset() {
        $this->menu = 'general_store';
        $this->sub_menu = 'asset';
        $this->sub_inner_menu = 'asset_list';
        $this->titlebackend("Add Asset");   
        $data['asset_categories']=$this->m_common->get_row_array('asset_category','','*');   
        $asset_last_code=$this->m_common->get_row_array('asset_code','','*','',1,'id','DESC');
        if(!empty($asset_last_code)){
           
            $asset_code=$asset_last_code[0]['asset_code']+1;
            if($asset_code>999){
                $asset_sl_no=$asset_code;
            }else if($asset_code>99){
                $asset_sl_no="0".$asset_code;
            }else if($asset_code>9){
                $asset_sl_no="00".$asset_code;
            }else{
                $asset_sl_no="000".$asset_code;
            }
        }else{
            $asset_code=1;
            $asset_sl_no='0001';
        }
        $data['asset_code']=$asset_code;
        $data['asset_auto_number']=$asset_sl_no;
        $this->load->view('asset/v_add_asset',$data);
    }

    function add_asset_action() {
        $postData = $this->input->post();
        $asset_code = $this->input->post('asset_code');
        if (!empty($postData)) {
            $insertData = array();
            if(!empty($postData['product_name'])){
                $insertData['product_name'] = $postData['product_name'];
            }
            
            if(!empty($postData['product_id'])){
                $insertData['product_id'] = $postData['product_id'];
                $product_test=$this->m_common->get_row_array('assets',array('product_id'=>$postData['product_id']),'*');
                if(!empty($product_test)){
                     redirect_with_msg('backend/asset/add_asset', 'This product already exits');
                }
             }
             
            if(!empty($postData['a_category'])){
                $insertData['a_category'] = $postData['a_category'];
             }
             
            if(!empty($postData['a_band'])){
                $insertData['a_band'] = $postData['a_band'];
            }
            if(!empty($postData['a_model'])){
                $insertData['a_model'] = $postData['a_model'];
            }
           
            if(!empty($postData['a_quantity'])){
                $insertData['a_quantity'] = $postData['a_quantity'];
            }
           
           
           if (isset($_FILES['a_image']['name']) && !empty($_FILES['a_image']['name'])) {
                $filename = uploadImage('a_image', 'images/asset');
                $insertData['a_image'] = $filename;
           }   
           $insertData['a_created_date'] = date('Y-m-d');
           
            $result=$this->m_common->insert_row('assets', $insertData);
            if(!empty($result)){   
                $this->m_common->insert_row('asset_code', array('asset_code'=>$asset_code));
                redirect_with_msg('backend/asset', 'Inserted Successfully');
            } else {
                redirect_with_msg('backend/asset/add_asset', 'Insertion Error');
            }
        } else {
            redirect_with_msg('backend/asset/add_asset', 'Please Post the form first');
        }
    }

    function edit_asset($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'asset';
        $this->sub_inner_menu = 'asset_list';
        $this->titlebackend("Edit Asset");     
        $data['asset_categories']=$this->m_common->get_row_array('asset_category','','*');   
        $data['asset'] = $this->m_common->get_row_array('assets', array('a_id' => $id), '*');
        $this->load->view('asset/v_edit_asset', $data);
    }
    
     function show_asset($id) {
         $this->menu = 'general_store';
        $this->sub_menu = 'asset';
        $this->sub_inner_menu = 'asset_list';
        $this->titlebackend("Details Asset");
        $data['vendors']=$this->m_common->get_row_array('vendor','','*');
        $data['asset_categories']=$this->m_common->get_row_array('asset_category','','*');
        $data['departments']=$this->m_common->get_row_array('department','','*');
        $data['asset'] = $this->m_common->get_row_array('assets', array('a_id' => $id), '*');
        $this->load->view('asset/v_show_asset', $data);
    }

   
     function details_asset($id) {
        $this->menu = 'general_store';
        $this->sub_menu = 'asset';
        $this->sub_inner_menu = 'asset_list';
        $this->titlebackend("Details Asset");  
        $data['asset'] = $this->m_common->get_row_array('assets', array('a_id' => $id), '*');
       
        
        $this->load->view('asset/v_details_asset', $data);
    }
    
    

    function edit_asset_action($id) {
        $postData = $this->input->post();
        $existData=$this->m_common->get_row_array('assets',array('a_id'=>$id),'a_image');
        if (!empty($postData)) {
            $insertData = array();
             if(!empty($postData['product_name'])){
                $insertData['product_name'] = $postData['product_name'];
            }
            
            if(!empty($postData['product_id'])){
                $insertData['product_id'] = $postData['product_id'];
             }
            if(!empty($postData['a_category'])){
                $insertData['a_category'] = $postData['a_category'];
             }
            if(!empty($postData['a_band'])){
                $insertData['a_band'] = $postData['a_band'];
            }
            if(!empty($postData['a_model'])){
                $insertData['a_model'] = $postData['a_model'];
            }
            if(!empty($postData['a_quantity'])){
                $insertData['a_quantity'] = $postData['a_quantity'];
            }
           
           
          
           
           if (isset($_FILES['a_image']['name']) && !empty($_FILES['a_image']['name'])) {
               if (!empty($existData[0]['a_image']) && file_exists('images/asset/' . $existData[0]['a_image']))
                    unlink('images/asset/' . $existData[0]['a_image']);
                $filename = uploadImage('a_image', 'images/asset');
                $insertData['a_image'] = $filename;
           }
                 
            if ($this->m_common->update_row('assets', array('a_id' => $id), $insertData)) {
                redirect_with_msg('backend/asset', 'Update Successfully');
            } else {
                redirect_with_msg('backend/asset/edit_asset/'.$id, 'Update Error');
            }
        } else {
            redirect_with_msg('backend/asset/edit_asset/'.$id, 'Please Post the form first');
        }
    }

    function delete_asset() {
        $ids = explode(',', $this->input->post('ids'));
        foreach ($ids as $id) {   
            $existData=$this->m_common->get_row_array('assets',array('a_id'=>$id),'a_image');
            $result=$this->m_common->delete_row('assets', array('a_id' => $id));
            if(!empty($result)){
                 if (!empty($existData[0]['a_image']) && file_exists('images/asset/' . $existData[0]['a_image']))
                    unlink('images/asset/' . $existData[0]['a_image']);
            }
            
        }
        echo 'success';
    }

    function delete_single_asset($id) {
         $existData=$this->m_common->get_row_array('assets',array('a_id'=>$id),'a_image');
        if ($this->m_common->delete_row('assets', array('a_id' => $id))){  
            if (!empty($existData[0]['a_image']) && file_exists('images/asset/' . $existData[0]['a_image']))
                    unlink('images/asset/' . $existData[0]['a_image']);
            
            
            redirect_with_msg('backend/asset', 'successfully deleted');
        }else
            redirect_with_msg('backend/asset', 'Not deleted');
       }
       
       
       
       function import() {
        $this->menu = 'asset';
        $this->sub_menu = 'asset';
        $this->titlebackend("Import Asset");   
        
      
        $this->load->view('asset/v_asset_importData');
        
     } 
     
     
      function importAction() {
       
            if (isset($_FILES['asset'])) {
                $file = fopen($_FILES['asset']['tmp_name'], "r");
                $i = 0;

                while (!feof($file)) {
                    $i++;
                    $row = fgetcsv($file);
                    if ($i > 1) {
                        if (empty($row[1])) {
                            continue;
                        }
                        $asset = array(); 
                        if (!empty($row[5])) {
                            $dep = $this->m_common->get_row_array('asset_category', array('category_name' => trim($row[5])), '*');
                            if (!empty($dep)) {
                                $category = $dep[0]['category_id'];
                            } else {
                                $category = $this->m_common->insert_row('asset_category', array('category_name' => trim($row[5]), 'description' => $row[5],'created'=>date('Y-m-d')));
                            }
                        } else {
                            $category = '';
                        }


      
                        $asset['product_name'] = $row[1];
                        $asset['product_id'] = $row[2];
                        if(!empty($row[3])){
                            $asset['a_model'] = $row[3];
                        }
                        if(!empty($row[4])){
                            $asset['a_band'] = $row[4];
                        }
                       
                        $asset['a_category'] = $category;
                        
                      
                        $asset['a_quantity'] = $row[6];
                       
                       
                        
                         $asset['a_created_date'] = date('Y-m-d');
                         $assetId = $this->m_common->insert_row('assets', $asset);
                       

                       
                    }
                }
                redirect_with_msg('backend/asset', 'Successfully Imported ' . ($i - 2) . ' Asset');
            } else {
                redirect_with_msg('backend/asset/import', 'Please Import csv file');
            }
        
    }
       
    
    
    
   function add_category(){
         $postData = $this->input->post();
         if(!empty($postData['category_name'])){
               $insertData['category_name'] = $postData['category_name'];
          }
          if(!empty($postData['description'])){
               $insertData['description'] = $postData['description'];
          }
         $insertData['created'] = date('Y-m-d');
          $assetId = $this->m_common->insert_row('asset_category', $insertData);
          if(!empty($assetId)){
            redirect_with_msg('backend/asset/add_asset', 'Successfully category added');
          }else{
              redirect_with_msg('backend/asset/add_asset', 'Category not added');
          }
   }
   
   
   
    function add_department(){
         $postData = $this->input->post();
         if(!empty($postData['department_name'])){
               $insertData['department_name'] = $postData['department_name'];
          }
          if(!empty($postData['description'])){
               $insertData['description'] = $postData['description'];
          }
         $insertData['created'] = date('Y-m-d');
          $assetId = $this->m_common->insert_row('department', $insertData);
          if(!empty($assetId)){
            redirect_with_msg('backend/asset/add_asset', 'Successfully department added');
          }else{
              redirect_with_msg('backend/asset/add_asset', 'Department not added');
          }
   } 
    
   
   
    function add_vendor(){
         $postData = $this->input->post();
         if(!empty($postData['v_name'])){
               $insertData['v_name'] = $postData['v_name'];
          }
          
          if(!empty($postData['v_phone'])){
               $insertData['v_phone'] = $postData['v_phone'];
          }
          
         if(!empty($postData['v_fax'])){
               $insertData['v_fax'] = $postData['v_fax'];
          }
          
         if(!empty($postData['v_email'])){
               $insertData['v_email'] = $postData['v_email'];
          } 
          
          if(!empty($postData['v_company'])){
               $insertData['v_company'] = $postData['v_company'];
          }  
          
         if(!empty($postData['v_website'])){
               $insertData['v_website'] = $postData['v_website'];
          }
          
          if(!empty($postData['v_address'])){
               $insertData['v_address'] = $postData['v_address'];
          }
          
         $insertData['created'] = date('Y-m-d');
          $assetId = $this->m_common->insert_row('vendor', $insertData);
          if(!empty($assetId)){
            redirect_with_msg('backend/asset/add_asset', 'Successfully vendor added');
          }else{
              redirect_with_msg('backend/asset/add_asset', 'Vendor not added');
          }
   } 
    
     
       

}




