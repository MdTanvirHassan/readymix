<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Products_cost extends Site_Controller {

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
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'product_cost';
        $this->titlebackend("Quotations");
       // $data['quotations']=$this->m_common->get_row_array('tbl_sales_quotation
       // $sql="select q.*,p.product_name,p.p_psi,p.measurement_unit,p.performance,c.c_short_name from tbl_product_quote_price q left join tbl_sales_products p on q.product_id=p.product_id left join tbl_customers c on q.customer_id=c.id where q.is_active=1";
      //  $sql="select q.*,p.product_name,p.p_psi,p.measurement_unit,p.performance,c.c_short_name from tbl_product_quote_price q left join tbl_sales_products p on q.product_id=p.product_id left join tbl_customers c on q.customer_id=c.id where q.is_active=1 order by q.status DESC";
      //  $sql="select q.*,p.product_name,p.p_psi,p.measurement_unit,p.performance,c.c_short_name from tbl_product_quote_price q left join tbl_sales_products p on q.product_id=p.product_id left join tbl_customers c on q.customer_id=c.id where q.is_active=1 and q.unit_id=".$branch_id." order by q.status DESC";
        $sql="select q.*,p.product_name,p.p_psi,p.measurement_unit,p.performance,c.c_short_name,pr.project_name from tbl_product_quote_price q
             left join tbl_sales_products p on q.product_id=p.product_id 
             left join tbl_customers c on q.customer_id=c.id 
             left join tbl_project pr on q.project_id=pr.project_id 
             where q.is_active=1 and q.unit_id=".$branch_id." order by q.product_cost_id DESC";
        $data['costs']=$this->m_common->customeQuery($sql);
        $this->load->view('products_cost/v_product_cost',$data);
    }

   
     function add_product_cost() {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'product_cost';
        $this->titlebackend("Quotation Information");
        //$data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
        $sql="select mp.*,p.product_name,p.p_psi,p.measurement_unit,p.performance from tbl_mixing_products mp left join tbl_sales_products p on mp.product_id=p.product_id where mp.is_active=1";
        $data['products']=$this->m_common->customeQuery($sql);
        $data['materials']=$this->m_common->get_row_array('items','','*');
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        $this->load->view('products_cost/v_add_product_cost',$data);
    }
     function add_product_cost_action() {
         $branch_id= $this->session->userdata('companyId');
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
             $insertOtherCost=array();
             
             if(!empty($postData['product_id'])){
                 $insertData['product_id']=$postData['product_id'];
             }
             
             if(!empty($postData['casting_size_cum'])){
                 $insertData['casting_size_cum']=$postData['casting_size_cum'];
             }
             
             if(!empty($postData['casting_size_cum'])){
                 $insertData['casting_size_cum']=$postData['casting_size_cum'];
             }
             
             if(!empty($postData['casting_size_cft'])){
                 $insertData['casting_size_cft']=$postData['casting_size_cft'];
             }
             if(!empty($postData['customer_id'])){
                 $insertData['customer_id']=$postData['customer_id'];
             }
           
            if(!empty($postData['cost_number'])){
                 $insertData['cost_number']=$postData['cost_number'];
            }
             
            if(!empty($postData['quote_price'])){
                 $insertData['quote_price']=$postData['quote_price'];
            } 
            
           if(!empty($postData['price_in_cft'])){
                $insertData['price_in_cft']=$postData['price_in_cft'];
           }  
            
             
           if(!empty($postData['project_id'])){
                $insertData['project_id']=$postData['project_id'];
           }  
            
           $pre_cost=$this->m_common->get_row_array('tbl_product_quote_price',array('product_id'=>$postData['product_id'],'customer_id'=>$postData['customer_id'],'status'=>'Pending','is_active'=>1,'project_id'=>$postData['project_id']),'*');
           if(!empty($pre_cost)){
              //  redirect_with_msg('products_cost/add_product_cost', 'Already cost estimated for this product');
           } 
           
           
            if(!empty($postData['foh'])){
                $insertOtherCost['foh']=$postData['foh'];
            }
            if(!empty($postData['aoh'])){
                $insertOtherCost['aoh']=$postData['aoh'];
            }
            if(!empty($postData['soh'])){
                $insertOtherCost['soh']=$postData['soh'];
            }  
           if(!empty($postData['final_expense'])){
                $insertOtherCost['final_expense']=$postData['final_expense'];
            } 
            
           if(!empty($postData['overhead_expense'])){
                $insertOtherCost['overhead_expense']=$postData['overhead_expense'];
           }
           if(!empty($postData['transport_cost'])){
                $insertOtherCost['transport_cost']=$postData['transport_cost'];
           }
           
           if(!empty($postData['pumping_cost'])){
                $insertOtherCost['pumping_cost']=$postData['pumping_cost'];
           }
           
           if(!empty($postData['sales_commission'])){
                $insertOtherCost['sales_commission']=$postData['sales_commission'];
           } 
           if(!empty($postData['admin_exp'])){
                $insertOtherCost['admin_exp']=$postData['admin_exp'];
           } 
           if(!empty($postData['dep_exp'])){
                $insertOtherCost['dep_exp']=$postData['dep_exp'];
           } 
           
            if(!empty($postData['vat'])){
                $insertOtherCost['vat']=$postData['vat'];
            } 
           if(!empty($postData['ait'])){
                $insertOtherCost['ait']=$postData['ait'];
            }
           
            if(!empty($postData['profit_percentage'])){
               $insertOtherCost['profit_percentage']=$postData['profit_percentage'];
            } 
           if(!empty($postData['profit_amount'])){
               $insertOtherCost['profit_amount']=$postData['profit_amount'];
           }    
            
             $insertData['unit_id']=$branch_id;
             $insertData['is_active']=1;  
             $insertData['status']='Pending'; 
             $insertData['created_date']=date('Y-m-d');
             $result=$this->m_common->insert_row('tbl_product_quote_price',$insertData);
             if(!empty($result)){
                  $this->m_common->insert_row('tbl_product_cost_code',array('customer_id'=>$postData['customer_id'],'cost_code'=>$postData['cost_code'],'unit_id'=>$branch_id));
                  $insertOtherCost['product_cost_id'] = $result;
                  $this->m_common->insert_row('tbl_sales_product_other_cost',$insertOtherCost);
                  foreach ($postData['m_id'] as $key => $each) {
                      $insertData1=array();
                      $insertData1['product_cost_id'] = $result;
                      $insertData1['m_id'] = $each;
                      $insertData1['is_active']=1;
                      if(empty($each)){
                          continue;
                      }
                      if(!empty($postData['brand'][$key])) {
                           $insertData1['brand'] = $postData['brand'][$key];
                      }
                      if(!empty($postData['quantity'][$key])) {
                           $insertData1['quantity'] = $postData['quantity'][$key];
                      }
                       if(!empty($postData['rate'][$key])) { 
                          $insertData1['rate'] = $postData['rate'][$key];
                       }
                       if(!empty($postData['value'][$key])) { 
                          $insertData1['value'] = $postData['value'][$key];
                       }
                       if(!empty($postData['conversion_factor'][$key])) { 
                          $insertData1['conversion_factor'] = $postData['conversion_factor'][$key];
                       }
                       if(!empty($postData['c_quantity'][$key])) { 
                          $insertData1['c_quantity'] = $postData['c_quantity'][$key];
                       }
                       if(!empty($postData['mu'][$key])) { 
                          $insertData1['mu']=$postData['mu'][$key];
                       }
                       
                       if(!empty($postData['c_mu'][$key])) { 
                          $insertData1['c_mu'] = $postData['c_mu'][$key];
                       }
                 
                      $this->m_common->insert_row('tbl_sales_product_material_cost',$insertData1);
                  }
                  redirect_with_msg('products_cost', 'Successfully Inserted');
             }
         }else{
              redirect_with_msg('products_cost/add_product_cost', 'Please fill the form and submit');
         }
         
     }
    
    function edit_product_cost($id) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'product_cost';
        $this->titlebackend("Product Costing");
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
       // $data['product_quote_price']=$this->m_common->get_row_array('tbl_product_quote_price',array('product_cost_id'=>$id),'*');
        $m_sql="select qp.*,sp.measurement_unit from tbl_product_quote_price qp left join tbl_sales_products sp on qp.product_id=sp.product_id where qp.product_cost_id=".$id;
        $data['product_quote_price']=$this->m_common->customeQuery($m_sql);
        $p=$this->m_common->get_row_array('tbl_project',array('customer_id'=>$data['product_quote_price'][0]['customer_id'],'is_active'=>1),'*');
        $data['projects']=$this->m_common->get_row_array('tbl_project',array('customer_id'=>$data['product_quote_price'][0]['customer_id'],'is_active'=>1),'*');
       
        $data['product_other_cost']=$this->m_common->get_row_array('tbl_sales_product_other_cost',array('product_cost_id'=>$id),'*');
        $sql="select spmc.*,item.item_name,item.meas_unit from tbl_sales_product_material_cost spmc left join items item on spmc.m_id=item.id where spmc.is_active=1 and spmc.product_cost_id=".$id;
        $data['material_costs']=$this->m_common->customeQuery($sql);
        $this->load->view('products_cost/v_edit_product_cost',$data);
    }
    
    function details_product_cost($id) {
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'product_cost';
        $this->titlebackend("Product Costing");
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
        //$data['product_quote_price']=$this->m_common->get_row_array('tbl_product_quote_price',array('product_cost_id'=>$id),'*');
        $m_sql="select qp.*,sp.measurement_unit from tbl_product_quote_price qp left join tbl_sales_products sp on qp.product_id=sp.product_id where qp.product_cost_id=".$id;
        $data['product_quote_price']=$this->m_common->customeQuery($m_sql);
        $data['projects']=$this->m_common->get_row_array('tbl_project',array('customer_id'=>$data['product_quote_price'][0]['customer_id'],'is_active'=>1),'*');
        $data['product_other_cost']=$this->m_common->get_row_array('tbl_sales_product_other_cost',array('product_cost_id'=>$id),'*');
        $sql="select spmc.*,item.item_name,item.meas_unit from tbl_sales_product_material_cost spmc left join items item on spmc.m_id=item.id where spmc.is_active=1 and spmc.product_cost_id=".$id;
        $data['material_costs']=$this->m_common->customeQuery($sql);
        $this->load->view('products_cost/v_details_product_cost',$data);
    }
    function productCostSheet($id,$print=''){
        $this->menu = 'sales';
        $this->sub_menu = 'sale';
        $this->sub_inner_menu = 'product_cost';
        $this->titlebackend("Product Costing");
        $data['customers']=$this->m_common->get_row_array('tbl_customers',array('is_active'=>1),'*');
        $data['products']=$this->m_common->get_row_array('tbl_sales_products',array('is_active'=>1),'*');
        //$data['product_quote_price']=$this->m_common->get_row_array('tbl_product_quote_price',array('product_cost_id'=>$id),'*');
       // $m_sql="select qp.*,sp.measurement_unit from tbl_product_quote_price qp left join tbl_sales_products sp on qp.product_id=sp.product_id where qp.product_cost_id=".$id;
      //  $m_sql="select qp.*,sp.measurement_unit,sp.product_name,sp.p_psi,p.project_name from tbl_product_quote_price qp left join tbl_sales_products sp on qp.product_id=sp.product_id left join tbl_project p on qp.project_id=p.project_id where qp.product_cost_id=".$id;
        $m_sql="select qp.*,sp.measurement_unit,sp.product_name,sp.p_psi,p.project_name,tc.c_name from tbl_product_quote_price qp left join tbl_customers tc on qp.customer_id=tc.id left join tbl_sales_products sp on qp.product_id=sp.product_id left join tbl_project p on qp.project_id=p.project_id where qp.product_cost_id=".$id;
        $data['product_quote_price']=$this->m_common->customeQuery($m_sql);
        $data['projects']=$this->m_common->get_row_array('tbl_project',array('customer_id'=>$data['product_quote_price'][0]['customer_id'],'is_active'=>1),'*');
        $data['product_other_cost']=$this->m_common->get_row_array('tbl_sales_product_other_cost',array('product_cost_id'=>$id),'*');
       // $sql="select spmc.*,item.item_name,item.meas_unit from tbl_sales_product_material_cost spmc left join items item on spmc.m_id=item.id where spmc.is_active=1 and spmc.product_cost_id=".$id;
        $sql="select spmc.*,item.item_name from tbl_sales_product_material_cost spmc left join items item on spmc.m_id=item.id  where spmc.is_active=1 and spmc.product_cost_id=".$id;
        $data['material_costs']=$this->m_common->customeQuery($sql);
        if(!empty($print)){
            $html=$this->load->view('products_cost/print_product_cost_sheet',$data,true);
            echo $html;exit;
        }else{
            $this->load->view('products_cost/v_product_cost_sheet',$data);
        }
    }
    
    function edit_product_cost_action($p_c_id) {
         $postData=$this->input->post();
         if(!empty($postData)){
             $insertData=array();
             $insertOtherCost=array();
             
             
             if(!empty($postData['product_id'])){
                 $insertData['product_id']=$postData['product_id'];
             }
             
             if(!empty($postData['casting_size_cum'])){
                 $insertData['casting_size_cum']=$postData['casting_size_cum'];
             }
             
             if(!empty($postData['casting_size_cft'])){
                 $insertData['casting_size_cft']=$postData['casting_size_cft'];
             }
             if(!empty($postData['product_id'])){
                 $insertData['product_id']=$postData['product_id'];
             }
             if(!empty($postData['customer_id'])){
                 $insertData['customer_id']=$postData['customer_id'];
             }
             if(!empty($postData['quote_price'])){
                 $insertData['quote_price']=$postData['quote_price'];
             } 
             
            if(!empty($postData['price_in_cft'])){
                $insertData['price_in_cft']=$postData['price_in_cft'];
            }
             
            if(!empty($postData['project_id'])){
                $insertData['project_id']=$postData['project_id'];
            }
            
            if(!empty($postData['foh'])){
                $insertOtherCost['foh']=$postData['foh'];
            }
            if(!empty($postData['aoh'])){
                $insertOtherCost['aoh']=$postData['aoh'];
            }
            if(!empty($postData['soh'])){
                $insertOtherCost['soh']=$postData['soh'];
            }  
           if(!empty($postData['final_expense'])){
                $insertOtherCost['final_expense']=$postData['final_expense'];
           } 
            
           if(!empty($postData['overhead_expense'])){
                $insertOtherCost['overhead_expense']=$postData['overhead_expense'];
           }
           if(!empty($postData['transport_cost'])){
                $insertOtherCost['transport_cost']=$postData['transport_cost'];
           }
           
           if(!empty($postData['pumping_cost'])){
                $insertOtherCost['pumping_cost']=$postData['pumping_cost'];
           }
           
           if(!empty($postData['sales_commission'])){
                $insertOtherCost['sales_commission']=$postData['sales_commission'];
           }
            
            if(!empty($postData['vat'])){
                $insertOtherCost['vat']=$postData['vat'];
            } 
           if(!empty($postData['ait'])){
                $insertOtherCost['ait']=$postData['ait'];
            }
           
            if(!empty($postData['profit_percentage'])){
                $insertOtherCost['profit_percentage']=$postData['profit_percentage'];
            } 
           if(!empty($postData['profit_amount'])){
               $insertOtherCost['profit_amount']=$postData['profit_amount'];
           }    
            
             
             
             $result=$this->m_common->update_row('tbl_product_quote_price',array('product_cost_id'=>$p_c_id),$insertData);
             if($result>=0){
                  
                  $this->m_common->update_row('tbl_sales_product_other_cost',array('product_cost_id'=>$p_c_id),$insertOtherCost);
                  $this->m_common->delete_row('tbl_sales_product_material_cost',array('product_cost_id'=>$p_c_id));
                  foreach ($postData['m_id'] as $key => $each) {
                      $insertData1=array();
                      $insertData1['product_cost_id'] = $p_c_id;
                      $insertData1['m_id'] = $each;
                      $insertData1['is_active']=1;
                      if(empty($each)){
                          continue;
                      }
                      if(!empty($postData['brand'][$key])) {
                           $insertData1['brand'] = $postData['brand'][$key];
                      }
                      if(!empty($postData['quantity'][$key])) {
                           $insertData1['quantity'] = $postData['quantity'][$key];
                      }
                       if(!empty($postData['rate'][$key])) { 
                          $insertData1['rate'] = $postData['rate'][$key];
                       }
                       if(!empty($postData['value'][$key])) { 
                          $insertData1['value'] = $postData['value'][$key];
                       }
                       
                      if(!empty($postData['conversion_factor'][$key])) { 
                          $insertData1['conversion_factor'] = $postData['conversion_factor'][$key];
                      }
                      if(!empty($postData['c_quantity'][$key])) { 
                          $insertData1['c_quantity'] = $postData['c_quantity'][$key];
                      }
                      
                      if(!empty($postData['mu'][$key])) { 
                          $insertData1['mu'] = $postData['mu'][$key];
                       }
                       
                      if(!empty($postData['c_mu'][$key])) { 
                          $insertData1['c_mu'] = $postData['c_mu'][$key];
                      }
                 
                      $this->m_common->insert_row('tbl_sales_product_material_cost',$insertData1);
                  }
                  redirect_with_msg('products_cost', 'Successfully Updated');
             }
         }else{
              redirect_with_msg('products_cost/edit_product_cost/'.$p_c_id, 'Please fill the form and submit');
         }
         
     }
     
     function delete_product_cost($id) {
        if(!empty($id)) {
            $id = $this->m_common->update_row('tbl_product_quote_price', array('product_cost_id' => $id),array('is_active'=>0));
            if (!empty($id)) {
                $this->m_common->update_row('tbl_sales_product_other_cost', array('product_cost_id' => $id),array('is_active'=>0));
                $this->m_common->update_row('tbl_sales_product_material_cost', array('product_cost_id' => $id),array('is_active'=>0));
                redirect_with_msg('products_cost/index', 'Successfully Deleted');
            } else {
                redirect_with_msg('products_cost/index', 'Data not deleted for an unexpected error');
            }
        } else {
            redirect_with_msg('products_cost/index', 'Please click on delete button');
        }
    }
     
    function get_item_material(){
        $this->setOutputMode(NORMAL);
        $id=$this->input->post('product_id');     
       // $mixing_product=$this->m_common->get_row_array('tbl_mixing_products',array('product_id'=>$id,'is_active'=>1),'*');
       // $m_sql="select mp.*,sp.measurement_unit from tbl_mixing_products mp left join tbl_sales_products sp on mp.product_id=sp.product_id where mp.product_id=".$id;
        $m_sql="select mp.*,sp.measurement_unit from tbl_mixing_products mp left join tbl_sales_products sp on mp.product_id=sp.product_id where mp.is_active=1 and  mp.product_id=".$id;
        $mixing_product=$this->m_common->customeQuery($m_sql);
        $data['product_info']=$mixing_product;
        if(!empty($mixing_product[0]['mixing_id'])){
           // $sql="select mpm.*,items.item_name,items.meas_unit from tbl_mixing_product_materials mpm left join items  on mpm.m_id=items.id where mpm.mixing_id=".$mixing_product[0]['mixing_id'];
            $sql="select mpm.*,items.item_name,tmu.meas_unit from tbl_mixing_product_materials mpm left join items  on mpm.m_id=items.id left join tbl_measurement_unit as tmu on mpm.mu_id=tmu.id where mpm.is_active=1 and mpm.mixing_id=".$mixing_product[0]['mixing_id'];
            $data['item_list']=$this->m_common->customeQuery($sql);
        }else{
            $data['item_list']='';
        }
  
        
        echo json_encode($data);
    }
   
     
    function customer_info(){
        $this->setOutputMode(NORMAL);
        $branch_id= $this->session->userdata('companyId');
        $id=$this->input->post('id');
        $data['projects']=$this->m_common->get_row_array('tbl_project',array('customer_id'=>$id,'is_active'=>1),'*');
        $data['quotaion']=$this->m_common->get_row_array('tbl_product_cost_code',array('customer_id'=>$id,'unit_id'=>$branch_id),'*','',1,'id','DESC');
        $customer=$this->m_common->get_row_array('tbl_customers',array('id'=>$id,'is_active'=>1),'*');
        if(!empty($customer)){
            $data['customer_info']=$customer;
        }else{
            $data['customer_info']='';
        }
        echo json_encode($data);
    } 

}




