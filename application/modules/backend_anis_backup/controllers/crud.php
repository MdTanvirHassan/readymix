<?php

/*
 * Author: fouraxiz
 * Purpose: This Controller is using for login process
 */

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Crud extends Site_Controller {

    function __construct() {
        parent::__construct();
        ini_set('max_execution_time', 600);
set_time_limit ( 600 );
ini_set('memory_limit', '2048M');
        if (!$this->is_logged_in($this->session->userdata('logged_in'))) {
            redirect_with_msg('backend/login', 'Please Login to see this page');
        }
        $this->load->library('grocery_CRUD');
        $this->load->model("m_common");
        $this->setTemplateFile('template');
        $this->user_id = $this->session->userdata('user_id');
    }

    public function _example_output($output = null) {
        $this->load->view('crud.php', (array) $output);
    }

    function category() {
        $this->menu = 'category';
        $this->sub_menu = 'category';
        $this->titlebackend("Category List");
        try {
            $crud = new grocery_CRUD();

            //    $crud->set_theme('datatables');
            $crud->set_table('category');
            $crud->set_subject('Category List');
            $crud->display_as('ct_name', 'Category Name');
            $crud->display_as('sl_id', 'Sales Line');
            $crud->fields('sl_id', 'ct_name');
            $crud->columns('sl_id', 'ct_name');
            $crud->required_fields('ct_name', 'sl_id');
            $crud->set_relation('sl_id', 'sales_line', 'sl_name');
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function sales_line() {
        $this->menu = 'sales_line';
        $this->sub_menu = 'sales_line';
        $this->titlebackend("Sales Line List");
        try {
            $crud = new grocery_CRUD();

            //    $crud->set_theme('datatables');
            $crud->set_table('sales_line');
            $crud->set_subject('Sales Line List');
            $crud->display_as('sl_name', 'Sales Line Name');
            $crud->display_as('sl_short_form', 'Short Form');
            $crud->fields('sl_name', 'sl_short_form');
            $crud->columns('sl_name', 'sl_short_form');
            $crud->required_fields('sl_name', 'sl_short_form');
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function brand() {
        $this->menu = 'brand';
        $this->sub_menu = 'brand';
        $this->titlebackend("Brand List");
        try {
            $crud = new grocery_CRUD();

            //     $crud->set_theme('datatables');
            $crud->set_table('brand');
            $crud->set_subject('Brand List');
            $crud->display_as('ct_id', 'Category Name');
            $crud->display_as('b_name', 'Brand Name');
            $crud->fields('ct_id', 'b_name');
            $crud->columns('ct_id', 'b_name');
            $crud->required_fields('ct_id', 'b_name');
            $crud->set_relation('ct_id', 'category', 'ct_name');
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function molecule_list() {
        $this->menu = 'molecule_list';
        $this->sub_menu = 'molecule_list';
        $this->titlebackend("Molecule List");
        try {
            $crud = new grocery_CRUD();

            //    $crud->set_theme('datatables');
            $crud->set_table('molecule_list');
            $crud->set_subject('Molecule List');
            $crud->display_as('mol_name', 'Molecule Name');
            $crud->fields('mol_name');
            $crud->columns('mol_name');
            $crud->required_fields('mol_name');
            $crud->set_rules('mol_name', 'mol_name', 'trim|required|xss_clean|is_unique[molecule_list.mol_name]');
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    
      function molecule_subline() {
        $this->menu = 'melecule_subline';
        $this->sub_menu = 'melecule_subline';
        $this->titlebackend("Molecule Subline");
        try {
            $crud = new grocery_CRUD();

            //    $crud->set_theme('datatables');
            $crud->set_table('v_molecule_subline');
            $crud->set_subject('Molecule Subline');
            $crud->display_as('ing', 'Molecule Name');
            $crud->display_as('sales_line', 'SALES-LINE');
            $crud->display_as('sub_line', 'SUB-LINE');
            $crud->fields('ing','sales_line','sub_line');
            $crud->columns('ing','sales_line','sub_line','b_name','ct_name');
            $crud->required_fields('ing','sales_line','sub_line');
           
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    
    
    function major_institute() {
        $this->menu = 'major_institute';
        $this->sub_menu = 'major_institute';
        $this->titlebackend("Major Institute");
        try {
            $crud = new grocery_CRUD();

            //    $crud->set_theme('datatables');
            $crud->set_table('major_institute');
            $crud->set_subject('Major Institute');
            $crud->display_as('inst_brick', 'Brick');
            $crud->display_as('inst_shop_name', 'Institution Name');
            $crud->display_as('inst_address', 'Address');
            $crud->fields('inst_brick','inst_shop_name','inst_address');
            $crud->columns('inst_brick','inst_shop_name','inst_address');
            $crud->required_fields('inst_brick','inst_shop_name','inst_address');
           
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    
     function other_molecule_pre() {
        $this->menu = 'other_molecule';
        $this->sub_menu = 'other_molecule';
        $this->titlebackend("Other Molecule List");
        try {
            $crud = new grocery_CRUD();

            //    $crud->set_theme('datatables');
            $crud->set_table('other_molecule');
            $crud->set_subject('Other Molecule List');
            $crud->display_as('sl_id', 'Sales Line');
            $crud->display_as('ct_id', 'Category Name');
            $crud->display_as('b_id', 'Brand Name');
            $crud->display_as('sl_name', 'Sales Line');
            $crud->display_as('ct_name', 'Category');
            $crud->display_as('b_name', 'Brand');
            $crud->display_as('status', 'Brand Share Syntax');
            $crud->display_as('mol_name', 'Molecule Name');
            $crud->fields('sl_id', 'ct_id', 'b_id', 'mol_name', 'status');
            $crud->columns('sl_name', 'ct_name', 'b_name', 'mol_name', 'status');
            $crud->required_fields('sl_id', 'ct_id', 'b_id', 'mol_name', 'status');
            $crud->set_rules('mol_name', 'mol_name', 'trim|required|xss_clean|is_unique[molecule_list.mol_name]');
            $crud->set_relation('sl_id', 'sales_line', 'sl_name');
            $crud->set_relation('ct_id', 'category', 'ct_name');
            $crud->set_relation('b_id', 'brand', 'b_name');
            
            
            $fields = array(
                'sl_id' => array(// first dropdown name 
                    'table_name' => 'sales_line', // table of country
                    'title' => 'sl_name', // country title
                    'relate' => null // the first dropdown hasn't a relation
                ),
                'ct_id' => array(// second dropdown name
                    'table_name' => 'category', // table of state
                    'title' => 'ct_name', // state title
                    'id_field' => 'ct_id', // table of state: primary key
                    'relate' => 'sl_id', // table of state:
                    'data-placeholder' => 'Select Category' //dropdown's data-placeholder:
                ),
                'b_id' => array(// second dropdown name
                    'table_name' => 'brand', // table of state
                    'title' => 'b_name', // state title
                    'id_field' => 'b_id', // table of state: primary key
                    'relate' => 'ct_id', // table of state:
                    'data-placeholder' => 'Select Brand' //dropdown's data-placeholder:
                )
            );
            $config = array(
                'main_table' => 'other_molecule',
                'main_table_primary' => 'om_id',
                "url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/',
            );
            $categories = new gc_dependent_select($crud, $fields, $config);
            $js = $categories->get_js();
            $crud->unset_add();
            
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }
    
    
     function other_molecule() {
        $this->menu = 'other_molecule';
        $this->sub_menu = 'other_molecule';
        $this->titlebackend("Other Molecule List");
        try {
            $crud = new grocery_CRUD();

            //    $crud->set_theme('datatables');
            $crud->set_table('other_molecule');
            $crud->set_subject('Other Molecule List');
            $crud->display_as('mol_name', 'Molecule Name');
            $crud->fields( 'mol_name');
            $crud->columns('mol_name');
            $crud->required_fields('sl_id', 'ct_id', 'b_id', 'mol_name', 'status');
            
            
            
          
          
          
            
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function territory() {
        $this->menu = 'territory';
        $this->sub_menu = 'territory';
        $this->titlebackend("Territory List");
        try {
            $crud = new grocery_CRUD();

            //   $crud->set_theme('datatables');
            $crud->set_table('v_territory');
            $crud->set_subject('Territory List');
            $crud->display_as('t_territory', 'Territory Name');
            $crud->display_as('sl_short_form', 'Sales Line');
            $crud->display_as('t_subline', 'Subline');
            $crud->display_as('t_note', 'Note');
            $crud->display_as('t_team', 'Team');
            $crud->display_as('t_region', 'Territory Region');
            $crud->display_as('t_status', 'Territory Status');
            $crud->display_as('t_email', 'Email');
            $crud->fields('t_territory', 'sl_short_form', 't_email', 't_subline', 't_note', 't_team', 't_region', 't_status');
            $crud->columns('t_territory', 'sl_short_form', 't_email', 't_subline', 't_note', 't_team', 't_region');
            $crud->required_fields('t_territory', 'sl_short_form', 't_email', 't_subline', 't_team', 't_region');
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function territory_target() {
        $this->menu = 'territory_target';
        $this->sub_menu = 'territory_target';
        $this->titlebackend("Territory Target");
        try {
            $crud = new grocery_CRUD();
            $this->load->library('gc_dependent_select');
            //     $crud->set_theme('datatables');
            $crud->set_table('target');
            $crud->set_subject('Territory List');
            $crud->display_as('t_id', 'Territory Name');
            $crud->display_as('sl_id', 'Sales Line');
            $crud->display_as('tgt_year', 'Year');
            $crud->display_as('tgt_cycle', 'Cycle Name');
            $crud->display_as('tgt_base', 'Base Value');
            $crud->display_as('tgt_proposed', 'Proposed Value');
            $crud->display_as('tgt_target', 'Target Value');
            $crud->fields('sl_id', 't_id', 'tgt_year', 'tgt_cycle', 'tgt_base', 'tgt_proposed', 'tgt_target');
            $crud->columns('sl_id', 't_id', 'tgt_year', 'tgt_cycle', 'tgt_base', 'tgt_proposed', 'tgt_target');
            $crud->required_fields('sl_id', 't_id', 'tgt_year', 'tgt_cycle', 'tgt_base', 'tgt_proposed', 'tgt_target');
            $crud->set_relation('sl_id', 'sales_line', 'sl_name');
            $crud->set_relation('t_id', 'territory', 't_territory');
            $fields = array(
                'sl_id' => array(// first dropdown name
                    'table_name' => 'sales_line', // table of country
                    'title' => 'sl_short_form', // country title
                    'relate' => null // the first dropdown hasn't a relation
                ),
                't_id' => array(// second dropdown name
                    'table_name' => 'territory', // table of state
                    'title' => '{t_territory} - {t_subline}', // state title
                    'id_field' => 't_id', // table of state: primary key
                    'relate' => 't_salesline', // table of state:
                    'data-placeholder' => 'Select Territory' //dropdown's data-placeholder:
                )
            );
            $config = array(
                'main_table' => 'target',
                'main_table_primary' => 'tgt_id',
                "url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/',
            );
            $categories = new gc_dependent_select($crud, $fields, $config);
            $js = $categories->get_js();

            $output = $crud->render();
            $output->output.= $js;


            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function institute_territory() {
        $this->menu = 'institute_territory';
        $this->sub_menu = 'institute_territory';
        $this->titlebackend("Institute Territory List");
        try {
            $crud = new grocery_CRUD();

            //    $crud->set_theme('datatables');
            $crud->set_table('institute_territory');
            $crud->set_subject('Institute Territory List');
            $crud->display_as('int_brick', 'Brick');
            $crud->display_as('int_territory', 'Territory Name');
            $crud->display_as('int_salesline', 'Sales Line');
            $crud->display_as('int_subline', 'Subline');
            $crud->display_as('int_note', 'Note');
            $crud->display_as('int_team', 'Team');
            $crud->display_as('int_region', 'Territory Region');
            $crud->display_as('int_share', 'Share');
            $crud->fields('int_brick', 'int_territory', 'int_salesline', 'int_subline', 'int_note', 'int_team', 'int_region', 'int_share');
            $crud->columns('int_brick', 'int_territory', 'int_salesline', 'int_subline', 'int_note', 'int_team', 'int_region', 'int_share');
            $crud->required_fields('int_brick', 'int_territory', 'int_salesline', 'int_subline', 'int_note', 'int_team', 'int_region', 'int_share');
            $crud->set_relation('int_territory', 'territory', 't_territory');
            $crud->set_relation('int_salesline', 'sales_line', 'sl_name'); //added by alauddin
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function institute() {
        $this->menu = 'institute';
        $this->sub_menu = 'institute';
        $this->titlebackend("Institute List");
        try {
            $crud = new grocery_CRUD();

            //  $crud->set_theme('datatables');
            $crud->set_table('institute');
            $crud->set_subject('Institute List');
            $crud->display_as('inst_shop_sl', 'Shop SL');
            $crud->display_as('inst_shop_id', 'Shop ID');
            $crud->display_as('inst_spbasm', 'SPBASM');
            $crud->display_as('inst_spbmpo', 'SPBMPO');
            $crud->display_as('inst_shop_name', 'Shop Name');
            $crud->display_as('inst_address', 'Address');
            $crud->display_as('inst_district', 'District');
            $crud->display_as('inst_thana', 'Thana');
            $crud->display_as('inst_brick', 'Brick');
            $crud->display_as('inst_dummy_terr', 'Dummey Territory');
            $crud->fields('inst_shop_sl', 'inst_shop_id', 'inst_spbasm', 'inst_spbmpo', 'inst_shop_name', 'inst_address', 'inst_district', 'inst_thana', 'inst_brick', 'inst_dummy_terr');
            $crud->columns('inst_brick', 'inst_shop_id', 'inst_spbasm', 'inst_spbmpo', 'inst_shop_name', 'inst_address', 'inst_district', 'inst_thana');
            $crud->required_fields('inst_shop_sl', 'inst_shop_id', 'inst_spbasm', 'inst_spbmpo', 'inst_shop_name');
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function doctors() {
        $this->menu = 'doctors';
        $this->sub_menu = 'doctors';
        $this->titlebackend("Doctors List");
        try {
            $crud = new grocery_CRUD();

            //   $crud->set_theme('datatables');
            $crud->set_table('physician');
            $crud->set_subject('Doctors List');
            $crud->display_as('phy_no', 'Physician ID');
            $crud->display_as('phy_name', 'Physician Name');
            $crud->display_as('phy_degree', 'Degree');
            $crud->display_as('phy_speciality', 'Speciality');
            $crud->display_as('phy_address', 'Address');
            $crud->display_as('phy_district', 'District');
            $crud->display_as('phy_thana', 'Thana');
            $crud->display_as('phy_year', 'Year');
            $crud->display_as('phy_brick', 'Brick');
            $crud->display_as('phy_notes', 'Notes');
            $crud->display_as('phy_mt', 'MT');
            $crud->display_as('phy_cns', 'CNS');
            $crud->display_as('phy_card', 'Card');
            $crud->display_as('phy_oad', 'OAD');
            $crud->display_as('phy_port', 'Port');
            $crud->display_as('phy_status', 'Status');
            $crud->fields('phy_no', 'phy_name', 'phy_degree', 'phy_speciality', 'phy_address', 'phy_district', 'phy_thana', 'phy_year', 'phy_brick', 'phy_notes', 'phy_mt', 'phy_cns', 'phy_card', 'phy_oad', 'phy_port', 'phy_status');
            $crud->columns('phy_no', 'phy_name', 'phy_degree', 'phy_speciality', 'phy_address');
            $crud->required_fields('phy_no', 'phy_name', 'phy_degree', 'phy_speciality', 'phy_address', 'phy_district', 'phy_thana', 'phy_year');
            $output = $crud->render();

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function molecule_relation() {
        $this->menu = 'molecule';
        $this->sub_menu = 'molecule';
        $this->titlebackend("Molecule-Relation List");
        try {
            $crud = new grocery_CRUD();
            $this->load->library('gc_dependent_select');
            //  $crud->set_theme('datatables');
            $crud->set_table('v_molecule_relation');
            $crud->set_subject('Molecule List');
            $crud->display_as('sl_id', 'Sales Line');
            $crud->display_as('ct_id', 'Category Name');
            $crud->display_as('b_id', 'Brand Name');
            $crud->display_as('mol_id', 'Molecule Name');
            $crud->display_as('status', 'Brand Share Syntax');
            $crud->fields('sl_id', 'ct_id', 'b_id', 'mol_id', 'status');
            $crud->columns('sl_id', 'ct_id','sub_line', 'b_id', 'mol_id', 'status');
            $crud->required_fields('sl_id', 'ct_id', 'b_id', 'mol_id', 'status');
            $crud->set_relation('sl_id', 'sales_line', 'sl_name');
            $crud->set_relation('ct_id', 'category', 'ct_name');
            $crud->set_relation('b_id', 'brand', 'b_name');
            $crud->set_relation('mol_id', 'molecule_list', 'mol_name');
            $crud->set_rules('mol_id', 'mol_id', 'trim|required|xss_clean|is_unique[molecule_list.mol_id]');
            $fields = array(
                'sl_id' => array(// first dropdown name
                    'table_name' => 'sales_line', // table of country
                    'title' => 'sl_name', // country title
                    'relate' => null // the first dropdown hasn't a relation
                ),
                'ct_id' => array(// second dropdown name
                    'table_name' => 'category', // table of state
                    'title' => 'ct_name', // state title
                    'id_field' => 'ct_id', // table of state: primary key
                    'relate' => 'sl_id', // table of state:
                    'data-placeholder' => 'Select Category' //dropdown's data-placeholder:
                ),
                'b_id' => array(// second dropdown name
                    'table_name' => 'brand', // table of state
                    'title' => 'b_name', // state title
                    'id_field' => 'b_id', // table of state: primary key
                    'relate' => 'ct_id', // table of state:
                    'data-placeholder' => 'Select Brand' //dropdown's data-placeholder:
                )
            );
            $config = array(
                'main_table' => 'molecule_relation',
                'main_table_primary' => 'mr_id',
                "url" => base_url() . strtolower(__CLASS__) . '/' . __FUNCTION__ . '/',
            );
            $categories = new gc_dependent_select($crud, $fields, $config);
            $js = $categories->get_js();

            $output = $crud->render();
            $output->output.= $js;

            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

    function achievement() {
        $this->menu = 'achievement';
        $this->sub_menu = 'achievement';
        $this->titlebackend("Achievement List");
        try {
            $crud = new grocery_CRUD();
            $this->load->library('gc_dependent_select');
            //      $crud->set_theme('datatables');
            $crud->set_table('achievement');
            $crud->set_subject('Achievement List');
            $crud->display_as('category', 'Category');
            $crud->display_as('achievement_bn', 'Achievement Bangla');
            $crud->display_as('achievement_en', 'Achievement English');
            $crud->display_as('district', 'District');
            $crud->display_as('thana', 'Thana');
            $crud->display_as('image', 'Image');
            $crud->fields('achievement_en', 'achievement_bn', 'category', 'district', 'thana', 'image');
            $crud->columns('achievement_en', 'achievement_bn', 'category', 'district', 'thana', 'image');
            $crud->required_fields('achievement_en', 'achievement_bn', 'category');
            $crud->set_relation('category', 'category', 'category_en');
            $crud->set_relation('district', 'district', 'district_name');
            $crud->set_relation('thana', 'thana', 'thana_name');
            $crud->set_field_upload('image', 'assets/uploads/files');

            $fields = array(
                'district' => array(// first dropdown name
                    'table_name' => 'district', // table of country
                    'title' => 'district_name', // country title
                    'relate' => null // the first dropdown hasn't a relation
                ),
                'thana' => array(// second dropdown name
                    'table_name' => 'thana', // table of state
                    'title' => 'thana_name', // state title
                    'id_field' => 'thana_id', // table of state: primary key
                    'relate' => 'district_id', // table of state:
                    'data-placeholder' => 'Select Thana' //dropdown's data-placeholder:
                )
            );
            $config = array(
                'main_table' => 'district',
                'main_table_primary' => 'district_id',
                "url" => base_url() . __CLASS__ . '/' . __FUNCTION__ . '/',
            );
            $categories = new gc_dependent_select($crud, $fields, $config);
            $js = $categories->get_js();


            $output = $crud->render();
            $output->output.= $js;
            $this->_example_output($output);
        } catch (Exception $e) {
            show_error($e->getMessage() . ' --- ' . $e->getTraceAsString());
        }
    }

}
